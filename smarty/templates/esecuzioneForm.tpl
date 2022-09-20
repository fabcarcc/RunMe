{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Esecuzioni</h1>
        <p class="lead">
            Esegui un comando
        </p>

        <p class="mb-5 ms-5">
            <strong>{$result->getNome()}</strong> - {$result->getDescrizione()}
        </p>
        <form method="post">
        <table class="table table-borderless">

        {foreach $result->getParametri() as $p}
            <tr>
                <td style="width: 3%">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="flexCheckDefault" value="1" name="check{$p->getId()}" {if $p->getObbligatorio()}checked disabled{/if}></div>
                </td>
                <td style="width: 25%"><strong>{$p->getNome()}</strong><br>{$p->getDescrizione()}</td>
                <td style="width: 30%"><div>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="val{$p->getId()}" value="{$p->getValore()}">
                    </div>
                </td>
                <td>&nbsp;</td>

            </tr>

{*            <tr>*}
{*                <th scope="row" class="text-center">{$r@iteration}</th>*}
{*                {if isset($admin)}*}
{*                    <td style="width: 10%" class="text-center"><img src="Assets/img/pencil.svg">&nbsp;&nbsp;<img src="Assets/img/files.svg">&nbsp;&nbsp;<img src="Assets/img/trash.svg"></td>*}
{*                {/if}*}
{*                <td class="p-0"><div class="position-relative p-2"><a href="Esecuzione/run/{$r->getId()}" class="stretched-link">{$r->getNome()}</a></div></td>*}
{*                <td class="p-0"><div class="position-relative p-2"><a href="Esecuzione/run/{$r->getId()}" class="stretched-link">{$r->getDescrizione()}</a></div></td>*}
{*            </tr>*}

            {foreachelse}
            Nessun parametro
        {/foreach}

            <tr>
                <td colspan="3" class="text-end">  <button type="submit" name="pippo" class="btn btn-primary">Esegui</button><input type="hidden" name="pp" value="ciao"></td>
            </tr>
        </table>
        </form>
    </div>

{/block}

