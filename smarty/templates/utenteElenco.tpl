{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Utenti</h1>
        <p class="lead">
            Scegli l'utente da gestire.
        </p>

        <p class="mb-5">
        </p>
    </div>
    <table class="table table-hover">

        <thead>
        <tr>
            <th scope="col" class="text-center" style="width: 3%">#</th>
            <th scope="col" style="width: 5%">&nbsp;</th>
            <th scope="col" style="width: 25%">Username</th>
            <th scope="col">&nbsp;</th>
        </tr>
        </thead>

        <tbody>

        {foreach $Utenti as $u}
            <tr class="
                {if $u->getID() == -1} table-secondary{/if}
                {if $u->getAdmin()} table-primary{/if}
                {if !$u->getAbilitato()} text-muted fst-italic{/if}
            ">
                <th scope="row" class="text-center">{$u@iteration}</th>
                <td style="width: 10%" class="text-center">{if $u->getID() != -1}<a href="/RunMe/Utente/newmod/{$u->getId()}"><img src="/RunMe/Assets/img/pencil.svg"></a>&nbsp;&nbsp;<img src="/RunMe/Assets/img/trash.svg">{/if}</td>
                <td>{$u->getUsername()}</td>
                <td>&nbsp;</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="3" class="text-center text-muted small">
                    <em> Nessun utente </em>
                <td>
            </tr>
        {/foreach}
            <tr>
                <th scope="row" class="text-center">&nbsp;</th>

                <td style="width: 10%" class="text-center"><a href="/RunMe/Utente/newmod/"><img src="/RunMe/Assets/img/plus-square.svg"></a>&nbsp;&nbsp;</td>
                <td colspan="2" class="text-muted small"><em>Aggiungi Nuovo Utente</em></td>
            </tr>

        </tbody>
    </table>
    <div class="text-center mt-4 mb-4">
        <a href="/RunMe/">Torna alle Esecuzioni</a>
    </div>

{/block}
