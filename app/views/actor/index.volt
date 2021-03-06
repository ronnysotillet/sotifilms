
{{ content() }}
</br>
<div align="right">
    {{ link_to("actor/new", "Crear Actor", "class": "btn btn-primary") }}
</div>

{{ form("actor/search") }}

<h2>Buscar Actor</h2>

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

<div class="control-group text-center">
    {{ submit_button("Search", "class": "btn btn-primary") }}
</div>

</fieldset>

</form>
