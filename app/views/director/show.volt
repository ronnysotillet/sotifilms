
{{ form("", 'role': 'form') }}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("director", "&larr; Go Back") }}
        </li>
    </ul>

    {{ content() }}

    <h2>Datos del Director</h2>

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
<label>Peliculas hechas por este Director</label>
{% for pelicula in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Duracion</th>
            <th>Genero</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ pelicula.id }}</td>
            <td>{{ link_to("pelicula/show/" ~pelicula.id, pelicula.nombre)}}</td>
            <td>{{ pelicula.duracion }}</td>
            <td>{{ pelicula.genero }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="4" align="right">
                <div class="btn-group">
                    {{ link_to("director/show/" ~ pelicula.id_director, '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("director/show/" ~ pelicula.id_director ~"/?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("director/show/" ~ pelicula.id_director ~"/?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("director/show/" ~ pelicula.id_director ~"/?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No existen Peliculas en el registro
{% endfor %}
