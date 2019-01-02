
{{ content() }}



{{ form("pelicula/search","class":"form-group") }}
</br>
<div align="right">
    {{ link_to("pelicula/new", "Crear Pelicula", "class": "btn btn-primary") }}
</div>
<h2>Buscar Pelicula</h2>
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
