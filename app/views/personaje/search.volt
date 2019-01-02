{{ content() }}

<ul class="pager">
    <li class="previous">
        {{ link_to("personaje", "&larr; Go Back") }}
    </li>
    <li class="next">
        {{ link_to("personaje/new", "Crear Director") }}
    </li>
</ul>

{% for personaje in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Interprete</th>
            <th>Pelicula</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ personaje.id }}</td>
            <td>{{link_to("personaje/show/"~personaje.id, personaje.nombre) }}</td>
            <td>{{ personaje.getActor().nombre }}</td>
            <td>{{ personaje.getPelicula().nombre }}</td>
            <td width="7%">{{ link_to("personaje/edit/" ~ personaje.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("personaje/delete/" ~ personaje.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="6" align="right">
                <div class="btn-group">
                    {{ link_to("personaje/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("personaje/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("personaje/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("personaje/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No existen personajes en el registro
{% endfor %}
