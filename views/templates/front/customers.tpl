{extends 'page.tpl'}

{block content}
<h2 id="customer_title">Ajout d'un client</h2> 

    <form action="#" method="POST">
        <div class="row mb-1">
            <div class="col">
                <label>Nom: </label>
                <input type="text" class="form-control" placeholder="Doe" name="nom">
            </div>
            <div class="col">
                <label>Prénom: </label>
                <input type="text" class="form-control" placeholder="John" name="prenom">
            </div>
            <div class="col">
                <label>Email: </label>
                <input type="text" class="form-control" placeholder="John.Doe@email.com" name="email">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-1" name="validate">Submit</button>
    </form>


{/block}