{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Logs</h1>
        <p class="lead">
            {if isset($targetUser)}
                Mostra i log per l'utente <strong>{$targetUser->getUsername()}</strong>.
            {elseif isset($targetEsecuzione)}
                Mostra i log per l'esecuzione <strong>{$targetEsecuzione->getNome()}</strong>.
            {/if}
            {if isset($Admin)} <small>(<a href="/RunMe/Log">Cambia</a>)</small>{/if}
        </p>

        <p class="mb-5"></p>
    </div>
    <table class="table table-hover">

        <thead>
        <tr>
            <th scope="col" class="text-center" style="width: 3%">#</th>
            <th scope="col" style="width: 20%">Data</th>
            <th scope="col">Log</th>
        </tr>
        </thead>

        <tbody>

        {foreach $Logs as $l}
            <tr
            {if $l->getTipo() == 1} class="table-warning" {/if}
            {if $l->getTipo() > 5} class="table-primary" {/if}>
                <th scope="row" class="text-center">{$l@iteration}</th>
                <td><div>{$l->getData()}</div></td>
                <td><div>{$l->getTesto()}</div></td>
            </tr>

            {foreachelse}
            <tr>
                <td colspan="3" class="text-center text-muted small">
                    <em> Nessun risultato </em>
                <td>
            </tr>
        {/foreach}
        </tbody>
    </table>
    <div class="text-center mt-4 mb-4">
        <a href="/RunMe/Log">Visualizza Log</a>&nbsp;&nbsp;<a href="/RunMe/">Torna alle Esecuzioni</a>
    </div>

{/block}
