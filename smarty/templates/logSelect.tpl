{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Logs</h1>
        <p class="lead">
            Seleziona i log da mostrare
        </p>

        <p class="mb-5"></p>
    </div>
    <div class="container text-center">

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                Seleziona l'Utente:
                <div class="list-group text-start mt-3 mb-3">
                    {foreach $Utenti as $u}
                       <a href="/RunMe/Log/mostraLogUtente/{$u->getId()}" class="list-group-item list-group-item-action
                       {if ($u->getId() == -1)}
                            list-group-item-secondary "><i>_ Utente Anonimo _</i></a>
                       {else}
                           {if ($u->getAdmin()) }list-group-item-primary{/if}
                           ">{$u->getUsername()}</a>
                       {/if}
                    {/foreach}
                </div>
            </div>

            <div class="col-md-auto">
                <i>o</i>
            </div>

            <div class="col col-lg-4">
                Seleziona l'Esecuzione:
                <div class="list-group text-start mt-3 mb-3">
                    {foreach $Esecuzioni as $e}
                        <a href="/RunMe/Log/mostraLogEsecuzione/{$e->getId()}" class="list-group-item list-group-item-action">{$e->getNome()}</a>
                    {/foreach}
                </div>
            </div>
        </div>

    </div>
    <div class="text-center mt-4 mb-4">
        <a href="/RunMe/">Torna all'elenco</a>
    </div>

    {/block}