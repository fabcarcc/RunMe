{extends file="base.tpl"}
{block name=body}

    <div class="text-center mb-4">
        {if isset($id)}<a href="/RunMe/Esecuzione/run/{$id}">Ripeti Esecuzione</a>&nbsp;&nbsp{/if}
        <a href="/RunMe/">Torna all'elenco</a>
    </div>

{/block}

