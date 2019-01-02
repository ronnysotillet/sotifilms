
{{ form("actor/save", 'role': 'form') }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("actor", "&larr; Go Back") }}
        </li>
    </ul>

    {{ content() }}

    <h2>Editar Actor</h2>

    <fieldset>

        {% for element in form %}
            {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                {{ element }}
            {% else %}
                <div class="form-group">
                    {{ element.label() }}
                    {{ element.render(['class': 'form-control']) }}
                </div>
            {% endif %}
        {% endfor %}
        <div class="pull-right">
            {{ submit_button("Actualizar", "class": "btn btn-success") }}
        </div >

    </fieldset>

</form>
