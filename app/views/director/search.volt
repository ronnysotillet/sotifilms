{{ content() }}

<ul class="pager">
    <li class="previous">
        {{ link_to("director", "&larr; Go Back") }}
    </li>
    <li class="next">
        {{ link_to("director/new", "Crear Director") }}
    </li>
</ul>

{% for director in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Nacimiento</th>
            <th>Nacionalidad</th>
            <th>Edad</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ director.id }}</td>
            <td>{{ link_to("director/show/" ~director.id, director.nombre) }}</td>
            <td>{{ director.fecha_nacimiento }}</td>
            <td>{{ director.nacionalidad }}</td>
            <td>{{ director.CalculaEdad() }}</td>
            <td width="7%">{{ link_to("director/edit/" ~ director.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("director/delete/" ~ director.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="6" align="right">
                <div class="btn-group">
                    {{ link_to("director/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("director/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("director/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("director/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No existen directores en el registro
{% endfor %}
