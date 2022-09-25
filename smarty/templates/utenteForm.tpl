{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Utenti</h1>
        <p class="lead">
            {if isset($target)}Modifica un utente
            {else}Crea un nuovo utente
            {/if}
        </p>

        <p class="mb-5 ms-5"></p>
        <form method="post" class="needs-validation" novalidate>
            <table class="table table-borderless">
                <tr>
                    <td style="width: 20%">Username:</td>
                    <td style="width: 35%"><div>
                            <input type="text" class="form-control" id="username" name="username" {if isset($target)}value="{$target->getUsername()}" disabled{/if} required>
                            <div class="invalid-feedback">Campo richiesto!</div>
                        </div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><div>
                            <input type="text" class="form-control" id="email" name="email" {if isset($target)}value="{$target->getEmail()}"{/if}>
                            <div class="invalid-feedback">Campo richiesto!</div>
                        </div></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" class="form-control" id="password" name="password" {if !isset($target)}required{/if}></td>
                </tr>
                <tr>
                    <td>Ripeti Password:</td>
                    <td><input type="password" class="form-control" id="password2" name="password2" {if !isset($target)}required{/if}></td>
                </tr>
                <tr>
                    <td>Amministratore:</td>
                    <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="admin" value="1" name="admin" {if ( isset($target) && $target->getAdmin() )}checked{/if}>
                        </div></td>
                </tr>
                <tr>
                    <td>Abilitato:</td>
                    <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="abilitato" value="1" name="abilitato" {if ( !isset($target) || $target->getAbilitato() )}checked{/if}>
                        </div></td>
                </tr>


                <tr>
                    <td colspan="2" class="text-end">  <button type="submit" class="btn btn-primary">Esegui</button></td>
                </tr>
            </table>
        </form>
        <div class="text-center mt-4 mb-4">
            <a href="/RunMe/Utente">Torna all'elenco</a>
        </div>
    </div>

{/block}

