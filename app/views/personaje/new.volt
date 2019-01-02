
{{ content() }}

{{ form("personaje/create") }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("personaje", "&larr; Go Back") }}
        </li>
    </ul>

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
            {{ submit_button("Guardar", "class": "btn btn-success") }}
        </div>
    </fieldset>

</form>
