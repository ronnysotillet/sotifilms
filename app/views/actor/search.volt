{{ content() }}

<ul class="pager">
    <li class="previous">
        {{ link_to("actor", "&larr; Go Back") }}
    </li>
    <li class="next">
        {{ link_to("actor/new", "Crear Actor") }}
    </li>
</ul>

{% for actor in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Nacimiento</th>
            <th>Nacionalidad</th>
            <th>Edad</th>
            <th>Genero</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ actor.id }}</td>
            <td>{{ link_to("actor/show/" ~ actor.id, actor.nombre) }}</td>
            <td>{{ actor.fecha_nacimiento }}</td>
            <td>{{ actor.nacionalidad }}</td>
            <td>{{ actor.CalculaEdad() }}</td>
            <td>{{ actor.obtenerGenero()}}</td>
            <td width="7%">{{ link_to("actor/edit/" ~ actor.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("actor/delete/" ~ actor.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("actor/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("actor/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("actor/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("actor/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No existen actores en el registro
{% endfor %}
