{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
    <h1>Esecuzioni</h1>
    <p class="lead">
        Scegli il comando da eseguire.
    </p>

    <p class="mb-5">
        {if !isset($user)}
            Questi sono i comandi pubblici che tutti possono eseguire (per vederne altri effettua il login):
        {elseif $user->getAdmin()}
            {assign "admin" 1}
            Questi sono tutti i comandi disponibili nel sistema:
        {else}
            Questi sono i comandi che hai il diritto di eseguire:
        {/if}
    </p>
    </div>
        <table class="table table-hover">

            <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 3%">#</th>
                {if isset($admin)}
                    <th scope="col" style="width: 5%">&nbsp;</th>
                {/if}
                <th scope="col" style="width: 25%">Nome</th>
                <th scope="col">Descrizione</th>
            </tr>
            </thead>

            <tbody>

    {foreach $results as $r}
            <tr>
                <th scope="row" class="text-center">{$r@iteration}</th>
                {if isset($admin)}
                    <td style="width: 10%" class="text-center"><img src="Assets/img/pencil.svg">&nbsp;&nbsp;<img src="Assets/img/files.svg">&nbsp;&nbsp;<img src="Assets/img/trash.svg"></td>
                {/if}
                <td class="p-0"><div class="position-relative p-2"><a href="Esecuzione/run/{$r->getId()}" class="stretched-link">{$r->getNome()}</a></div></td>
                <td class="p-0"><div class="position-relative p-2"><a href="Esecuzione/run/{$r->getId()}" class="stretched-link">{$r->getDescrizione()}</a></div></td>
            </tr>

    {foreachelse}
            <tr>
                <td colspan="3" class="text-center text-muted small">
                    <em> Nessun risultato </em>
                <td>
            </tr>
    {/foreach}
    {if isset($admin)}
        <tr>
            <th scope="row" class="text-center">&nbsp;</th>

            <td style="width: 10%" class="text-center"><img src="Assets/img/plus-square.svg">&nbsp;&nbsp;</td>
            <td colspan="2" class="text-muted small"><em>Aggiungi Nuova esecuzione</em></td>
        </tr>

    {/if}
            </tbody>
        </table>


{/block}
