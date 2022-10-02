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
                    <td style="width: 10%" class="text-center">
                        <a href="/RunMe/Esecuzione/newmod/{$r->getId()}"><img src="/RunMe/Assets/img/pencil.svg" alt="Modifica" title="Modifica"></a>&nbsp;&nbsp;
                        <a href="/RunMe/Esecuzione/clona/{$r->getId()}"><img src="/RunMe/Assets/img/files.svg" alt="Clona" title="Clona"></a>&nbsp;&nbsp;
                        {if isset($delete)}
                        <img alt="Elimina" title="Elimina" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-whatever="/RunMe/Esecuzione/delete/{$r->getId()}" src="/RunMe/Assets/img/trash.svg">
                        {/if}
                    </td>
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

            <td style="width: 10%" class="text-center"><a href="/RunMe/Esecuzione/newmod/"><img src="/RunMe/Assets/img/plus-square.svg"></a>&nbsp;&nbsp;</td>
            <td colspan="2" class="text-muted small"><em>Aggiungi Nuova esecuzione</em></td>
        </tr>

    {/if}
            </tbody>
        </table>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Attenzione!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3">
                    <p>Eliminando una esecuzione verranno definitivamente persi tutti i log relativi a questa!<br>
                        Invece di eliminarla, valuta la possibilità di disabilitarla o di rimuovere i diritti di esecuzione.</p>
                    <p>Sei sicuro di voler procedere?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <a href="#" id="deleteLink" type="button" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg> Elimina</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('deleteModal')
        modal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const targetLink = button.getAttribute('data-bs-whatever')
            const link = modal.querySelector('a')

            link.href = targetLink
        })
    </script>

{/block}
