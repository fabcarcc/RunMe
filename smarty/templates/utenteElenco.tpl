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
                <td style="width: 10%" class="text-center">{if $u->getID() != -1}
                        <a href="/RunMe/Utente/newmod/{$u->getId()}"><img alt="Modifica" src="/RunMe/Assets/img/pencil.svg"></a>&nbsp;&nbsp;
                        <img alt="Elimina" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-whatever="/RunMe/Utente/delete/{$u->getId()}" src="/RunMe/Assets/img/trash.svg">{/if}</td>
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

                <td style="width: 10%" class="text-center"><a href="/RunMe/Utente/newmod/"><img alt="Nuovo" src="/RunMe/Assets/img/plus-square.svg"></a>&nbsp;&nbsp;</td>
                <td colspan="2" class="text-muted small"><em>Aggiungi Nuovo Utente</em></td>
            </tr>

        </tbody>
    </table>
    <div class="text-center mt-4 mb-4">
        <a href="/RunMe/">Torna alle Esecuzioni</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Attenzione!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3">
                    <p>Eliminando un utente verranno definitivamente persi tutti i log relativi alle sue attività!<br>
                        Invece di eliminarlo, valuta la possibilità di disabilitarlo.</p>
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
