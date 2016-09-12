<div class="col-1">
    <p>
        <a target="blank" href="https://{{ $region }}.battle.net/wow/en/character/{{ mb_strtolower($character->realm) }}/{{ $character->name }}/advanced" class="softbutton">
            <img src="https://{{ $region }}.battle.net/static-render/{{ $region }}/{{ $character->avatar }}" alt="Sample Logos"/>
        </a>
    </p>
</div>
<div class="col-3 col-end">
    <p class="right">
        <small>Last updated - {{ $character->updated_at }}</small>
    </p>
    <h4>
        {!! $character->fullName !!}
    </h4>

    <h5 class="left"> <strong>{{ $character->level }}</strong>
        {{ $character->race }} <u>{{ $character->talent }}</u> {{ $character->class }}, <br>
        Realm: <span class="character-realm" title="Battlegroup: Misery">Kazzak</span>
    </h5>
    
    <table>
        <tr>
            <td>
                <strong>Item Level:</strong>
            </td>
            <td>
                {{ $character->ilvl_equipd }} / {{ $character->ilvl_avg }}
            </td>
        </tr>
    </table>
    <table>
        <tr>
            @if($character->guild !== null)
            <td>
                <strong>Guild:</strong>
            </td>
            <td>
                <a class="guild" href="http://{{ $region }}.battle.net/wow/en/guild/{{ mb_strtolower($character->realm) }}/{{ $character->guild }}/">
                    {{ $character->guild }}
                </a>
            </td>
            @else
            <td class="no-guild">
                <i>This character is currently not in a guild.</i>
            </td>
            @endif
        </tr>
    </table>
</div>