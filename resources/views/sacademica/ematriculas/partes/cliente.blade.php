<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos Personales.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('apellido', 'Apellidos', [null]) !!}
                    <input type="text" id="apellido" name="apellido" class="form-control" disabled>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('nombre', 'Nombres', [null]) !!}
                    <input type="text" id="nombre" name="nombre" class="form-control" disabled>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono', 'Telefono Llamadas', [null]) !!}
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono2', 'Telefono WhatsApp', [null]) !!}
                    <input type="text" id="telefono2" name="telefono2" class="form-control" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('fechaNacimiento', 'F. Nacimiento', ['class'=>'pb-2']) !!}
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('sexo', 'Sexo', ['class'=>'pb-2']) !!}
                    {!! Form::select('sexo', $sexos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('email', 'Correo', [null]) !!}
                    <label for="">
                        <button type="button" class="btn btn-info btn-sm" id="btn_mail">
                            <i class="fas fa-mail-bulk"></i>
                        </button>
                    </label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    {!! Form::label('direccion', 'Dirección', ['class'=>'pb-2']) !!}
                    <input type="text" id="direccion" name="direccion" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>