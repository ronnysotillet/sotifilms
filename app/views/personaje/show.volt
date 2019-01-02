
{{ content() }}

<div align="right">
     <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("personaje", "&larr; Go Back") }}
        </li>
    </ul>
</div>

{{ form("#") }}

<h2>Datos del Personaje</h2>

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

</fieldset>

</form>
