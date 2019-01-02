
{{ form("pelicula/save", 'role': 'form') }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("pelicula", "&larr; Go Back") }}
        </li>
    </ul>

    {{ content() }}

    <h2>Datos de la Pelicula</h2>

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

<label>Personajes que aparecen en la pelicula</label>

{% for personaje in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Interprete</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ personaje.id }}</td>
            <td>{{ link_to("personaje/show/" ~ personaje.id,personaje.nombre) }}</td>
            <td>{{ link_to("actor/show/" ~ personaje.id_actor, personaje.getActor().nombre) }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="3" align="right">
                <div class="btn-group">
                    {{ link_to("pelicula/show/" ~ personaje.id_pelicula, '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("pelicula/show/"~ personaje.id_pelicula~"/?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("pelicula/show/"~ personaje.id_pelicula~"/?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("pelicula/show/"~ personaje.id_pelicula~"/?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% endfor %}
