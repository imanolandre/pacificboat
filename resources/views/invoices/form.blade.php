<div id="page-loader" class="page-loader" style="display: none;">
    <div class="spinner"></div>
    <div id="loading-text" class="loading-text">Guardando</div>
</div>
<div id="content">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('week_id', 'Week') }}</label>
                <div>
                    {{ Form::select('week_id', $weeks->pluck('customer_name', 'id'), $invoice->week_id ?? null, ['class' => 'form-control tom-select form-select select2' . ($errors->has('week_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Week', 'id' => 'week_id']) }}
                    {!! $errors->first('week_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('yacht_name', 'Yacht Name') }}</label>
                <div>
                    {{ Form::text('yacht_name', $invoice->yacht_name ?? '', ['class' => 'form-control' . ($errors->has('yacht_name') ? ' is-invalid' : ''), 'placeholder' => 'Yacht Name', 'id' => 'yacht_name']) }}
                    {!! $errors->first('yacht_name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('location', 'Location') }}</label>
                <div>
                    {{ Form::text('location', $invoice->location ?? '', ['class' => 'form-control' . ($errors->has('location') ? ' is-invalid' : ''), 'placeholder' => 'Location', 'id' => 'location']) }}
                    {!! $errors->first('location', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('email', 'Email') }}</label>
                <div>
                    {{ Form::text('email', $invoice->email ?? '', ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'id' => 'email']) }}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('date', 'Date') }}</label>
                <div>
                    {{ Form::date('date', $invoice->date ?? '', ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date', 'id' => 'date']) }}
                    {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('due_date', 'Due Date') }}</label>
                <div>
                    {{ Form::date('due_date', $invoice->due_date ?? '', ['class' => 'form-control' . ($errors->has('due_date') ? ' is-invalid' : ''), 'placeholder' => 'Due Date', 'id' => 'due_date']) }}
                    {!! $errors->first('due_date', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div id="descriptions-container">
            <h4>Descriptions</h4>
            @foreach($invoice->details as $index => $detail)
            <div class="description-item row">
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('details['.$index.'][qty]', 'QTY') }}</label>
                        <div>
                            {{ Form::text('details['.$index.'][qty]', $detail->qty, ['class' => 'form-control', 'placeholder' => 'QTY']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('details['.$index.'][description]', 'Description') }}</label>
                        <div>
                            {{ Form::text('details['.$index.'][description]', $detail->description, ['class' => 'form-control', 'placeholder' => 'Description']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('details['.$index.'][date]', 'Date') }}</label>
                        <div>
                            {{ Form::date('details['.$index.'][date]', $detail->date, ['class' => 'form-control', 'placeholder' => 'Date']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ Form::label('details['.$index.'][total]', 'Total') }}</label>
                        <div>
                            {{ Form::text('details['.$index.'][total]', $detail->total, ['class' => 'form-control', 'placeholder' => 'Total']) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-description" class="btn btn-primary ms-auto texto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tada icon-tabler icon-tabler-pencil-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M15 19l2 2l4 -4" /></svg>
            Add Description
        </button>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="form-label">{{ Form::label('notes', 'Notes') }}</label>
                <div>
                    {{ Form::textarea('notes', $invoice->notes ?? '', ['class' => 'form-control h-7' . ($errors->has('notes') ? ' is-invalid' : ''), 'placeholder' => 'Notes']) }}
                    {!! $errors->first('notes', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <script>
           document.addEventListener('DOMContentLoaded', function () {
                var select = new TomSelect('.select2', {
                });

                document.getElementById('add-description').addEventListener('click', function() {
                    var container = document.getElementById('descriptions-container');
                    var count = container.getElementsByClassName('description-item').length;
                    var newItem = `
                        <div class="description-item row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">QTY</label>
                                    <div>
                                        <input type="text" name="details[` + count + `][qty]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description</label>
                                    <div>
                                        <input type="text" name="details[` + count + `][description]" class="form-control" placeholder="Description">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Date</label>
                                    <div>
                                        <input type="date" name="details[` + count + `][date]" class="form-control" placeholder="Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Total</label>
                                    <div>
                                        <input type="text" name="details[` + count + `][total]" class="form-control" placeholder="Total">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', newItem);
                });
            });

            function submitForm() {
                showSpinner();
                document.getElementById('your-form-id').submit();
            }

            function showSpinner() {
                document.getElementById('page-loader').style.display = 'flex';
                document.getElementById('loading-text').innerText = 'Guardando';
            }

            function hideSpinner() {
                document.getElementById('page-loader').style.display = 'none';
                document.getElementById('loading-text').innerText = '';
            }
        </script>
    </div>
    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <button type="reset" href="#" class="btn btn-secondary texto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4.55a8 8 0 0 1 6 14.9m0 -4.45v5h5" /><path d="M5.63 7.16l0 .01" /><path d="M4.06 11l0 .01" /><path d="M4.63 15.1l0 .01" /><path d="M7.16 18.37l0 .01" /><path d="M11 19.94l0 .01" /></svg>
                    Clean
                </button>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit texto" onclick="submitForm()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tada icon-tabler icon-tabler-pencil-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M15 19l2 2l4 -4" /></svg>
                    Save
                </button>
            </div>
        </div>
    </div>

</div>
<style>
    .form-control.color-input {
        height: calc(1.5em + .75rem + 7px); /* Igual a la altura del campo de texto */
        padding: .375rem .75rem; /* Igual al padding del campo de texto */
    }
    .texto{
        font-family: 'Poppins', sans-serif;
    }
    /* Estilos del Contenedor del Spinner */
    #page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.808);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1000; /* Asegura que esté por encima de otros elementos */
    }

    /* Estilos del Spinner */
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 4px solid #102b5e; /* Puedes ajustar el color según el esquema de colores de tu aplicación */
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }

    /* Animación del Spinner */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Estilos del Texto "Guardando" */
    .loading-text {
        margin-top: 10px;
    }

    .tom-select{
        background-color: #ffffff;
        color: #000000;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar Tom Select en el campo de selección del cliente
        var select = new TomSelect('.select2', {
            // Opciones de configuración de Tom Select
        });

    });
    function submitForm() {
        showSpinner();
        document.getElementById('your-form-id').submit();
    }

    function showSpinner() {
        document.getElementById('page-loader').style.display = 'flex';
        document.getElementById('loading-text').innerText = 'Guardando';
    }

    function hideSpinner() {
        document.getElementById('page-loader').style.display = 'none';
        document.getElementById('loading-text').innerText = '';
    }
</script>


