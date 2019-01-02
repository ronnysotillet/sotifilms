{{ content() }}

<ul class="pager">
    <li class="previous">
        {{ link_to("pelicula", "&larr; Go Back") }}
    </li>
    <li class="next">
        {{ link_to("pelicula/new", "Crear Pelicula") }}
    </li>
</ul>

{% for pelicula in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Duracion</th>
            <th>Genero</th>
            <th>Director</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ pelicula.id }}</td>
            <td>{{ link_to("pelicula/show/" ~ pelicula.id, pelicula.nombre)}}</td>
            <td>{{ pelicula.duracion }}</td>
            <td>{{ pelicula.genero }}</td>
            <td>{{ link_to("director/show/" ~ pelicula.id_director, pelicula.getDirector().nombre)}}</td>
            <td width="7%">{{ link_to("pelicula/edit/" ~ pelicula.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("pelicula/delete/" ~ pelicula.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="6" align="right">
                <div class="btn-group">
                    {{ link_to("pelicula/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("pelicula/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("pelicula/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("pelicula/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
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
