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
        <form method="post" class="needs-validation" novalidate>
        <table class="table table-borderless">

        {foreach $result->getParametri() as $p}
            {if ($p->getTipoParametro() != 3)}
            <tr>
                <td style="width: 3%">
                   <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="check{$p->getId()}" value="1" name="check{$p->getId()}"
                   {if $p->getTipoParametro() == 0}checked disabled{/if}
                   {if $p->getTipoParametro() == 1}checked{/if}
                   onclick="document.getElementById('val{$p->getId()}').disabled = ! this.checked "
                       >
                   </div>
                </td>
                <td style="width: 25%"><strong>{$p->getNome()}</strong><br>{$p->getDescrizione()}</td>
                <td style="width: 30%" class="align-middle">
                    {if ($p->getTipoValore() != 0)}
                    <div>
                        <input type="text" class="form-control" id="val{$p->getId()}" name="val{$p->getId()}" value="{$p->getValore()}"
                        {if $p->getTipoParametro() == 2} disabled{/if}
                        {if $p->getTipoValore() == 2} required><div class="invalid-feedback">Campo richiesto!</div{/if}>
                    </div>
                    {/if}
                </td>
                <td>&nbsp;</td>

            </tr>
            {/if}
{*            <tr>*}
{*                <th scope="row" class="text-center">{$r@iteration}</th>*}
{*                {if isset($admin)}*}
{*                    <td style="width: 10%" class="text-center"><img src="Assets/img/pencil.svg">&nbsp;&nbsp;<img src="Assets/img/files.svg">&nbsp;&nbsp;<img src="Assets/img/trash.svg"></td>*}
{*                {/if}*}
{*                <td class="p-0"><div class="position-relative p-2"><a href="Esecuzione/run/{$r->getId()}" class="stretched-link">{$r->getNome()}</a></div></td>*}
{*                <td class="p-0"><div class="position-relative p-2"><a href="Esecuzione/run/{$r->getId()}" class="stretched-link">{$r->getDescrizione()}</a></div></td>*}
{*            </tr>*}

            {foreachelse}
            <tr>
                <td style="width: 3%">&nbsp;</td>
                <td style="width: 25%"><i>Nessun parametro</i></td>
                <td style="width: 30%">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

        {/foreach}

            <tr>
                <td colspan="3" class="text-end">  <button type="submit" name="pippo" class="btn btn-primary">Esegui</button><input type="hidden" name="pp" value="ciao"></td>
            </tr>
        </table>
        </form>
        <div class="text-center mt-4 mb-4">
            <a href="/RunMe/">Torna all'elenco</a>
        </div>
    </div>

{*    <script>*}
{*        window.onload = toggleSelect(); // to disable select on load if needed*}

{*        function toggleSelect()*}
{*        {*}
{*            var isChecked = document.getElementById("stOne").checked;*}
{*            document.getElementById("selectOne").disabled = !isChecked;*}
{*        }*}

{*    </script>*}
{/block}

