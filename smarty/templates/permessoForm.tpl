{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Permessi</h1>
        <p class="lead">
            {if isset($targetUser)}
                Gestisci i permessi per l'utente <strong>{$targetUser->getUsername()}</strong>.
            {elseif isset($targetEsecuzione)}
                Gestisci i permessi per l'esecuzione <strong>{$targetEsecuzione->getNome()}</strong>.
            {/if}
            <small>(<a href="/RunMe/Permesso">Cambia</a>)</small>
        </p>

        <p class="mb-5"><small class="ms-3">Nota: i permessi per gli utenti amministratori hanno effetto solo se diventano utenti standard</small></p>

        <form method="post" class="needs-validation" novalidate>
            <table class="table table-borderless">
                {foreach $Lista as $el}
                <tr>
                    <td style="width: 3%">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="{$el['id']}" value="1" name="{$el['id']}" {if $el['on']}checked{/if}
                            onchange="document.getElementById('submit').disabled = false">
                        </div>
                    </td>
                    <td style="width: 30%">{$el['nome']}</td>
                    <td>&nbsp;</td>
                </tr>
                {/foreach}
                <tr>
                    <td colspan="2"><small class="ms-1">
                            <a onclick="document.querySelectorAll('input[type=checkbox]').forEach(input => input.checked = true); document.getElementById('submit').disabled = false">Tutti</a>
                            <a onclick="document.querySelectorAll('input[type=checkbox]').forEach(input => input.checked = false); document.getElementById('submit').disabled = false">Nessuno</a>
                        </small></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-end">  <button type="submit" id="submit" class="btn btn-primary" disabled>Modifica</button></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="text-center mt-4 mb-4">
        <a href="/RunMe/Permesso">Gestisci Permessi</a>&nbsp;&nbsp;<a href="/RunMe/">Torna alle Esecuzioni</a>
    </div>

{/block}
