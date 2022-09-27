{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Permessi</h1>
        <p class="lead">
            Seleziona i permessi da gestire
        </p>

        <p class="mb-5"></p>
    </div>
    <div class="container text-center">

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                Seleziona l'Utente:
                <div class="list-group text-start mt-3 mb-3">
                    {foreach $Utenti as $u}
                       <a href="/RunMe/Permesso/permessiUtente/{$u->getId()}" class="list-group-item list-group-item-action
                       {if ($u->getId() == -1)} list-group-item-secondary {/if}
                       {if ($u->getAdmin()) } list-group-item-primary{/if}
                       {if (!$u->getAbilitato())} text-muted fst-italic{/if}
                       ">{$u->getUsername()}</a>
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
                        <a href="/RunMe/Permesso/permessiEsecuzione/{$e->getId()}" class="list-group-item list-group-item-action">{$e->getNome()}</a>
                    {/foreach}
                </div>
            </div>
        </div>

    </div>
    <div class="text-center mt-4 mb-4">
        <a href="/RunMe/">Torna alle Esecuzioni</a>
    </div>

    {/block}
