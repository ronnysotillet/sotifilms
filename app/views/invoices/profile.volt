
{{ content() }}


<div class="profile left">
    {{ form('invoices/profile', 'id': 'profileForm', 'onbeforesubmit': 'return false','class':'form-group') }}
    <h2>Tus datos</h2>
        <div class="clearfix">
            <label for="name">Nombre:</label>
            <div class="input">
                {{ text_field("name", "size": "30", "class": "form-control") }}
                <div class="alert" id="name_alert">
                    <strong>Alerta!</strong> Por favor ingresa tu nombre.
                </div>
            </div>
        </div>
        <div class="clearfix">
            <label for="email">Email:</label>
            <div class="input">
                {{ text_field("email", "size": "30", "class": "form-control") }}
                <div class="alert" id="email_alert">
                    <strong>Alerta!</strong> Por favor ingresa tu email.
                </div>
            </div>
        </div>
        </br>
        <div class="clearfix">
            <input type="button" value="Actualizar" class="btn btn-primary btn-large btn-info" onclick="Profile.validate()">
            &nbsp;
            {{ link_to('invoices/index', 'Cancelar') }}
        </div>
    </form>
</div>