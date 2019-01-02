
{{ content() }}

<div class="page-header">
    <h2>Registrate en nuestro portal</h2>
</div>

{{ form('register', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}

    <fieldset>

        <div class="control-group">
            {{ form.label('name', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('name', ['class': 'form-control']) }}
                <div class="alert alert-warning" id="name_alert">
                    <strong>Alerta!</strong> Por favor ingresa tu nombre
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('username', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('username', ['class': 'form-control']) }}
                <div class="alert alert-warning" id="username_alert">
                    <strong>Alerta!</strong> Por favor ingresa un nombre de usuario
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('email', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('email', ['class': 'form-control']) }}
                <div class="alert alert-warning" id="email_alert">
                    <strong>Alerta!</strong> Por favor ingresa un e-mail
                </div>
            </div>
        </div>

        <div class="control-group">
            {{ form.label('password', ['class': 'control-label']) }}
            <div class="controls">
                {{ form.render('password', ['class': 'form-control']) }}
                <p class="help-block">(minimo 8 caracteres)</p>
                <div class="alert alert-warning" id="password_alert">
                    <strong>Alerta!</strong> Por favor ingresa una contraseña
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="repeatPassword">Repite la contraseña</label>
            <div class="controls">
                {{ password_field('repeatPassword', 'class': 'form-control') }}
                <div class="alert" id="repeatPassword_alert">
                    <strong>Alerta!</strong> La contraseña no coincide
                </div>
            </div>
        </div>
        </br>
        <div class="form-actions pull-rigth">
            {{ submit_button('Registrar', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
            <p class="help-block">Al registrarte, aceptas los términos de uso y la política de privacidad..</p>
        </div>

    </fieldset>
</form>
