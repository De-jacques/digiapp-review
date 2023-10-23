<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <div class="container d-flex justify-content-center mt-100">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-5">
                    Veuillez téléverser le fichier excel pour enrégistrer les produits
                </div>


                <div class="file-drop-area mt-5">
                    <span class="choose-file-button">Choisir le fichier</span>
                    <span class="file-message">ou faites glisser et déposez des fichiers ici</span>
                    <input class="file-input" type="file" multiple>
                </div>

            </div>

        </div>


    </div>
</body>

<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(to right, #8E24AA, #b06ab3);
        color: #D7D7EF;
        font-family: 'Lato', sans-serif;
    }

    h2 {
        margin: 50px 0;
    }



    .file-drop-area {
        position: relative;
        display: flex;
        align-items: center;
        width: 450px;
        max-width: 100%;
        padding: 25px;
        border: 1px dashed rgba(255, 255, 255, 0.4);
        border-radius: 3px;
        transition: 0.2s;

    }

    .choose-file-button {
        flex-shrink: 0;
        background-color: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 3px;
        padding: 8px 15px;
        margin-right: 10px;
        font-size: 12px;
        text-transform: uppercase;
    }

    .file-message {
        font-size: small;
        font-weight: 300;
        line-height: 1.4;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-input {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        cursor: pointer;
        opacity: 0;

    }

    .mt-100 {
        margin-top: 100px;
    }
</style>

</html>