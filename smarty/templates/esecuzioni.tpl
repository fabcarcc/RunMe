{extends file="base.tpl"}
{block name=body}

    Ciao!
    <table cellpadding=1 cellspacing=0 border=0 width=60%>
        {foreach $results as $r}
            <tr {if $r@iteration is odd} bgcolor="#ccc" {/if}>
                <td>
                    {$r@iteration}
                </td>
                <td>
                    {$r->getNome()}
                </td>
                <td>
                    {$r->getDescrizione()}
                </td>
            </tr>

            {foreachelse}
            <tr>
                <td align="center">
                    <b> nessun risultato </b>
                <td>
            </tr>
        {/foreach}

    </table>

{/block}
