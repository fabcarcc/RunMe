{extends file="base.tpl"}
{block name=body}

    <div class="ms-4">
        <h1>Esecuzioni</h1>
        <p class="lead">
            {if isset($target)}Modifica una esecuzione
            {else}Crea una nuova esecuzione
            {/if}
        </p>

        <p class="mb-5 ms-5"></p>
        <form method="post" class="needs-validation" novalidate>
            <table class="table table-borderless">
                <tr>
                    <td style="width: 20%">Nome:</td>
                    <td style="width: 35%"><div>
                            <input type="text" class="form-control" id="nome" name="nome" {if isset($target)}value="{$target->getNome()}"{/if} required>
                            <div class="invalid-feedback">Campo richiesto!</div>
                        </div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Descrizione:</td>
                    <td><div>
                            <input type="text" class="form-control" id="descrizione" name="descrizione" {if isset($target)}value="{$target->getDescrizione()}"{/if}>
                            <div class="invalid-feedback">Campo richiesto!</div>
                        </div></td>
                </tr>
                <tr>
                    <td>Seleziona Eseguibile:</td>
                    <td><div>
                            <select class="form-select" id="eseguibile" name="eseguibile" required>
                                <option value="">Seleziona...</option>
                                {foreach $eseguibili as $e}
                                <option value="{$e}" {if isset($target) && $target->getEseguibile() === $e}selected{/if}>{$e}</option>
                                {/foreach}
                                </select>
                            <div class="invalid-feedback">Campo richiesto!</div>
                        </div></td>
                    {if isset($upload)}
                    <td class="align-middle"><a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload</a> </td>
                    {/if}
                </tr>
                <tr>
                    <td>Mostra Output:</td>
                    <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="mostraoutput" value="1" name="mostraoutput" {if ( isset($target) && $target->getMostraOutput() )}checked{/if}>
                        </div></td>
                </tr>
                <tr>
                    <td>Abilitato:</td>
                    <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="abilitato" value="1" name="abilitato" {if ( !isset($target) || $target->getAbilitato() )}checked{/if}>
                        </div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="parametri">
                            {$nparam = 0}
                            {if isset($target)}
                            {foreach $target->getParametri() as $p}
                                {$nparam = $p@iteration}
                            <div id="parametro{$p@iteration}">
                                <div class="row ms-4 mb-2 mt-3">Parametro {$p@iteration}:</div>
                                <div class="row mb-2">
                                    <div class="col-4"><input type="text" class="form-control" id="{$p@iteration}nome" name="{$p@iteration}nome" placeholder="Nome" value="{$p->getNome()}" required>
                                        <div class="invalid-feedback">Campo richiesto!</div>
                                    </div>
                                    <div class="col-5"><input type="text" class="form-control" id="{$p@iteration}descrizione" name="{$p@iteration}descrizione" placeholder="descrizione" value="{$p->getDescrizione()}">
                                        <div class="invalid-feedback">Campo richiesto!</div>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-select" id="{$p@iteration}tipoParametro" name="{$p@iteration}tipoParametro" required>
                                            <option value="">Tipo Parametro...</option>
                                            <option value="0" {if $p->getTipoParametro() == 0}selected{/if}>Obbligatorio</option>
                                            <option value="1" {if $p->getTipoParametro() == 1}selected{/if}>Facoltativo default ON</option>
                                            <option value="2" {if $p->getTipoParametro() == 2}selected{/if}>Facoltativo default OFF</option>
                                            <option value="3" {if $p->getTipoParametro() == 3}selected{/if}>Nascosto</option>
                                        </select>
                                        <div class="invalid-feedback">Campo richiesto!</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"><input type="text" class="form-control" id="{$p@iteration}pre" name="{$p@iteration}pre" placeholder="Pre" value="{$p->getPre()}"></div>
                                    <div class="col-3"><input type="text" class="form-control" id="{$p@iteration}valore" name="{$p@iteration}valore" placeholder="Valore" value="{$p->getValore()}"></div>
                                    <div class="col-3"><input type="text" class="form-control" id="{$p@iteration}post" name="{$p@iteration}post" placeholder="post" value="{$p->getPost()}"></div>
                                    <div class="col-2">
                                        <select class="form-select" id="{$p@iteration}tipoValore" name="{$p@iteration}tipoValore" required>
                                            <option value="">Tipo Valore...</option>
                                            <option value="0" {if $p->getTipoValore() == 0}selected{/if}>Nessun valore</option>
                                            <option value="1" {if $p->getTipoValore() == 1}selected{/if}>Stringa (anche vuota)</option>
                                            <option value="2" {if $p->getTipoValore() == 2}selected{/if}>Stringa (NON vuota)</option>
                                            </select>
                                        <div class="invalid-feedback">Campo richiesto!</div>
                                    </div>
                                    <div class="col-1 d-flex align-items-center"><a href="#" onclick="document.getElementById('parametro{$p@iteration}').remove();return false"><img src="/RunMe/Assets/img/trash.svg"> </a></div>
                                </div>
                            </div>
                            {/foreach}
                            {/if}
                        </div>
                        <div class="row mt-5 mb-3">
                            <div class="col-11 text-end"><i>Aggiungi parametro</i></div>
                            <div class="col-1 d-flex align-items-center"><a href="#" onclick="addParametro();return false"><img src="/RunMe/Assets/img/plus-square.svg"> </a></div>
                        </div>
                    </td>
                </tr>



                <tr>
                    <td colspan="2" class="text-end">  <button type="submit" class="btn btn-primary">Esegui</button></td>
                </tr>
            </table>
        </form>
        <div class="text-center mt-4 mb-4">
            <a href="/RunMe/Esecuzione">Torna all'elenco</a>
        </div>
    </div>

    <script>
        let nparam = {$nparam}
    </script>
    <script src="/RunMe/Assets/js/addParametro.js"></script>

    {if isset($upload)}
    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/RunMe/Esecuzione/Upload" id="upload" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="modal-body mb-3">
                    <p>Carica un nuovo script</p>

                        <div>
                            <input type="file" name="upload" class="form-control" id="file" form="upload" required>
                            {if isset($target)}<input type="hidden" name="id" value="{$target->getId()}">{/if}
                            <div class="invalid-feedback">Seleziona un file!</div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" form="upload" class="btn btn-primary" id="Upload">Carica</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {/if}

{/block}

