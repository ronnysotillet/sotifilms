
{{ content() }}

<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2>Iniciar Sesion</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">Nombre de usuario / E-mail</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Iniciar Sesión', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-md-6">

        <div class="page-header">
            <h2>¿Aún no tienes una cuenta?</h2>
        </div>

        <p>Crear una cuenta ofrece las siguientes ventajas:</p>
        <ul>
            <li>Lleve un registro de sus peliculas, actores y directores favoritos</li>
            <li>Consulte cuando lo desee los datos de todos los registros</li>
            <li>Actualice los datos en el momento que lo desee</li>
        </ul>

        <div class="clearfix center">
            {{ link_to('register', 'Registrese', 'class': 'btn btn-primary btn-large btn-success') }}
        </div>
    </div>

</div>
