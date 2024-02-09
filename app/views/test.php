<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" id="tab-user" data-bs-toggle="tab" href="#">Active</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-post" data-bs-toggle="tab" href="#">Link</a>
    </li>
</ul>


    <div class="tab-pane fade show active" id="tabuser" role="tabpanel" aria-labelledby="tab-user">
        <div class="container col-lg-8 mt-4">
            <h1>Liste des Utilisateurs</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {% for user in users %}
                    <tr>
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <a href="{{ base_url }}user/{{ user.id }}/edit" class="btn btn-primary">Modifier</a>
                            <form action="{{ base_url }}user/{{ user.id }}/delete" method="POST" style="display:inline">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
            <a href="{{ base_url }}user/create" class="btn btn-success">Ajouter un Utilisateur</a>
        </div>
    </div>
    <div class="tab-pane fade" id="tabpost" role="tabpanel" aria-labelledby="tab-post">
        <h3>Contenu de l'onglet 2</h3>
        <p>Ceci est le contenu de l'onglet 2.</p>
    </div>
