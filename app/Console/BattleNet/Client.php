<?php

namespace App\Console\BattleNet;

use App\Character;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client AS HttpClient;

class Client
{
    use DataResource;

    protected $uri = 'https://{region}.api.battle.net/wow/character/{realm}/{character}?locale={locale}&apikey={apikey}&fields=guild,items,titles,talents';

    public function update(Character $model)
    {
        $url = $this->buildUriWith($this->buildMap($model));
        
        $response = $this->sendRequest($url);

        $this->write($model, new ApiCollection($response));
    }

    protected function write($model, $data)
    {
        $model->avatar = $data->get('thumbnail');
        $model->level  = $data->get('level');
        $model->race   = $this->formatRace($data->get('race'));
        $model->class  = $this->formatClass($data->get('class'));

        $model->ilvl_equipd = $data->get('items.averageItemLevelEquipped');
        $model->ilvl_avg    = $data->get('items.averageItemLevel');

        $model->guild = $data->has('guild') ? $data->get('guild.name') : null;

        $model->talent = $data->get('talents.1.spec.name');

        $characterTitle = '%s';
        foreach ($data->get('titles', []) AS $title) {
            if (! isset($title['selected'])) {
                continue;
            }

            $characterTitle = $title['name'];
        }

        $model->title = $characterTitle;
        $model->updated_at = Carbon::now();

        $model->save();
    }

    protected function buildUriWith($data)
    {
        $url = $this->uri;

        foreach ($data as $replace => $with) {
            $url = str_replace("{{$replace}}", $with, $url);
        }

        return $url;
    }

    protected function buildMap(Character $model)
    {
        $region = mb_strtolower(config('wow.region'));

        return [
            'region'    => $region,
            'realm'     => mb_strtolower($model->realm),
            'character' => $model->name,
            'locale'    => $this->locale[$region],
            'apikey'    => config('wow.token')
        ];
    }

    private function sendRequest($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // TODO: Find a way to verify the host using BattleNets SSL certificate.
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);
        $header = curl_getinfo($ch);

        curl_close($ch);

        return json_decode($output, true);
    }
}
