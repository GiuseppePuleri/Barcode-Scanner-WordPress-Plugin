<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Barcode Scanner</title>
        <style>
            body{
                background-color:#F3F3F3
            }
            .content-block {
                width: 80%; /* Cambia se desideri una larghezza diversa */
                margin: 0 auto; /* Per centrare il blocco */
                padding: 20px;
                background-color: #ffffff;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            }

            .container {
                display: flex;
                flex-direction: column;
                justify-content: center; /* Centra verticalmente */
                align-items: center;    /* Centra orizzontalmente */
                min-height: 100vh;      /* Imposta l'altezza minima a 100% della viewport */
            }


            header {
                background-color: white;
                color: #1E1E1E;
                padding: 0px;
                display: flex;
                align-items: center;
            }

            .logo img {
                width: 30px;
            }

            .title {
                color: #1E1E1E;

            }

            .title h1 {
                font-size: 14px;
            }

            .title .total {
                color: #1E1E1E;
            }

            .title .cache {
                color: #00B4FF;
            }

            .title .setup-guide {
                font-style: italic;
            }

            main {
                display: flex;
                flex: 1;
            }

            .content {
                flex: 1;
                padding: 20px;
                background-color: white;
            }

            .content h2 {
                margin-bottom: 15px;
                font-size: 22px;
            }

            .content p {
                margin-bottom: 15px;
            }

            label {
                font-size: 16px;
            }

            input[type="checkbox"] {
                margin-right: 10px;
            }

            footer {
                display: flex;
                justify-content: space-between;
            }

            footer button {
                padding: 10px 20px;
                border: none;
                cursor: pointer;
            }

            footer .next {
                background-color: #007CBA;
                color: white;
                width: 100%;
            }
        </style>

        <style>
            /* STILE PER LA PROGRESS BAR */

            .stepper-wrapper {
                margin-top: auto;
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .done::before {
                position: absolute;
                border-bottom: 9px solid #007CBA!important;
                width: 100%;
                top: 20px;
                left: -50%;
                z-index: 2;
            }

            .stepper-item {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                flex: 1;
            }

            .stepper-item::before {
                position: absolute;
                content: "";
                border-bottom: 9px solid #ccc;
                width: 100%;
                top: 20px;
                left: -50%;
                z-index: 2;
            }

            .stepper-item::after {
                position: absolute;
                content: "";
                border-bottom: 2px solid #ccc;
                width: 100%;
                top: 20px;
                left: 50%;
                z-index: 2;
            }

            .stepper-item .step-counter {
                position: relative;
                z-index: 5;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #ccc;
                margin-bottom: 6px;
            }

            .stepper-item.completed .step-counter {
                background-color: #007CBA;
            }

            .stepper-item.completed::after {
                border-bottom: 9px solid #007CBA;
            }

            .stepper-item:first-child::before {
                content: none;
            }

            .stepper-item:last-child::after {
                content: none;
            }

            select{
                width:20%;
                padding: 5px 30px 5px 5px!important;
            }

            .hidden{
                display:none;
            }
        </style>

        <style>
            .fade-in {
                animation: fadeIn 0.2s ease-in forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
<body>

    <!--HEADER UNO-->
    <div class="content-block"> <!-- Inizio blocco unico -->
        <header>
            <div class="title" style="width:100%; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h1 style="margin: 0;">Barcode Scanner</h1>
                <h1 style="color:#007CBA; margin: 0; margin-left: auto;">Connect the Scanner</h1>
                <svg style="margin-left:15px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
                </svg>
            </div>
            
        </header>
    </div>
    <br><br><br>

    <!--PARTE UNO -->
        <?php if (!isset($results)): ?>
            <div class="content-block">
                <main>
                    <section class="content">
                        <progress-bar>
                            <div class="stepper-wrapper">
                                <div class="stepper-item done completed">
                                    <div class="step-counter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                        </svg>
                                    </div>
                                    <div class="step-name "><b>Search products</b></div>
                                </div>
                                <div class="stepper-item">
                                    <div class="step-counter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                                        </svg>
                                    </div>
                                    <div class="step-name">Results</div>
                                </div>
                                <div class="stepper-item ">
                                    <div class="step-counter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                            <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                                        </svg>
                                    </div>
                                    <div class="step-name">End!</div>
                                </div>
                            </div>
                        </progress-bar>
                        <content>
                            <form method="POST" action="">
                                
                                <div style="margin:7% 0">
                                    <div class="row">
                                        <div class="col-10">
                                            <p>
                                                You can enter the product code here manually or via the appropriate reader.
                                                <br>
                                                <b>Search instructions:</b><i> Connect the scanner to the USB port of your computer, click on the words 'INSERT CODE HERE', now frame the product with the reader.</i>                                                
                                            </p>
                                        </div>
                                        <div class="col-2" style="text-align: end;">
                                            <img src="https://t3.ftcdn.net/jpg/04/18/86/74/360_F_418867490_j7NfQjFAblRosDambH3zGqDsUvqeX3g6.jpg" alt="Immagine scanner lettore ean 13" width="100px" style="margin-top:-20px;">
                                        </div>
                                        </div>
                                    <br>
                                    <br>
                                    <br>
                                    <input class="form-control me-2" type="text" id="sku" name="sku" placeholder="INSERT CODE HERE" aria-label="Search" required>
                                </div>

                                <br>

                                <footer>
                                    <button class="next" type="submit">Next</button>
                                </footer>
                            </form>

                        </content>
                    </section>
                </main>
            </div>
        <?php endif; ?>
    <!--PARTE UNO FINE -->


    <!--PARTE DUE -->
        <?php if (isset($results)): ?>
            <?php if (!empty($results)): ?>

                <div id="secondaParte" class="content-block">
                    <main>
                        <section class="content">
                            <progress-bar>
                                <div class="stepper-wrapper">
                                    <div class="stepper-item done completed">
                                        <div class="step-counter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                            </svg>
                                        </div>
                                        <div class="step-name">Search products</div>
                                    </div>
                                    <div class="stepper-item done completed">
                                        <div class="step-counter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                                            </svg>
                                        </div>
                                        <div class="step-name"><b>Results</b></div>
                                    </div>
                                    <div class="stepper-item">
                                        <div class="step-counter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                                            </svg>
                                        </div>
                                        <div class="step-name">End!</div>
                                    </div>
                                </div>
                            </progress-bar>
                            <content>
                                <div style="margin: 7% 0">
                                    <br>
                                    <div style="width: 100%; border: 1px solid #e5e5e5; padding: 20px;">
                                        <div style="display: flex; align-items: center;">
                                            <label for="product-type" style="font-weight: bold; margin-right: 10px">Products Found:</label>
                                        </div>
                                        <hr style="margin: 15px 0;">

                                        <?php foreach ($results as $result): ?>
                                        <div class="variation-item" data-variation-id="<?php echo esc_html($result->variation_id); ?>" style="border: 1px solid #ddd; margin-top: 20px; padding: 10px; background-color: #f9f9f9;">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>#<?php echo esc_html($result->variation_id); ?></div>
                                                <select style="border: 1px solid #ddd; padding: 5px;">
                                                    <option value="<?php echo esc_html($result->name); ?>">
                                                        <?php echo esc_html($result->name); ?>
                                                    </option>
                                                </select>
                                                <select style="border: 1px solid #ddd; padding: 5px;">
                                                    <option value="<?php echo esc_attr($result->price); ?>">
                                                        <?php echo esc_html('€ ' . $result->price); // Aggiungi il simbolo dell'euro prima del prezzo ?>
                                                    </option>
                                                </select>
                                                <select style="border: 1px solid #ddd; padding: 5px;">
                                                    <option value="<?php echo esc_html($result->color); ?>">
                                                        <?php echo esc_html($result->color); ?>
                                                    </option>
                                                </select>
                                                <select style="border: 1px solid #ddd; padding: 5px;">
                                                    <option value="<?php echo esc_html($result->size); ?>">
                                                        <?php echo esc_html($result->size); ?>
                                                    </option>
                                                </select>
                                                <button class="delete-variation" style="color: red; border: none; background: none; cursor: pointer;" data-variation-id="<?php echo esc_html($result->variation_id); ?>">Delete</button>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <footer>
                                    <a href="/wp-admin/admin.php?page=barcode-scanner" class="button" style="width:50%; display: inline-block; text-align: center; padding: 10px; background-color: #F0F0F0; border-color: #F0F0F0; color: black; text-decoration: none;">Back</a>
                                    <button class="next" type="submit" id="avantiButton" style="width:50%">Next</button>
                                </footer>
                            </content>
                        </section>
                    </main>
                </div>


            <?php else: ?>
                <p>No products found for the SKU entered.</p>
            <?php endif; ?>
        <?php endif; ?>
    <!--PARTE DUE FINE -->


    <!--PARTE TRE -->
    <div id="terzaParte" class="content-block hidden">
        <main>
            <section class="content">
                <progress-bar>
                    <div class="stepper-wrapper">
                        <div class="stepper-item done completed">
                            <div class="step-counter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </div>
                            <div class="step-name">Search products</div>
                        </div>
                        <div class="stepper-item done completed">
                            <div class="step-counter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag-fill" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                                </svg>
                            </div>
                            <div class="step-name">Results</div>
                        </div>
                        <div class="stepper-item done completed">
                            <div class="step-counter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                                </svg>
                            </div>
                            <div class="step-name"><b>End!</b></div>
                        </div>
                    </div>
                </progress-bar>
                <content>
                    <div style="margin: 7% 0">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>

                        <div id="alerts-container"></div>
                    </div>
                </content>
            </section>
        </main>
    </div>
    <!--PARTE TRE FINE -->



    <!-- JAVASCRIP -->
        <!-- Sezione due 'BOTTONE INDIETRO'-->
        <script>
            // Aggiungi un evento di ascolto per il clic sul pulsante con ID 'return'
            document.getElementById('return').addEventListener('click', function() {
                // Ricarica la pagina
                window.location.href = '/wp-admin/admin.php?page=barcode-scanner';
            });
        </script>

        <!-- Sezione due 'ELIMINA VARIAZIONE'-->
        <script>
            document.querySelectorAll('.delete-variation').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const variationId = this.getAttribute('data-variation-id');
                    
                    if (confirm('Sei sicuro di voler eliminare questa variazione?')) {
                        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'delete_variation',
                                variation_id: variationId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.querySelector(`.variation-item[data-variation-id="${variationId}"]`).remove();
                            } else {
                                alert('Si è verificato un errore durante l\'eliminazione della variazione.');
                            }
                        });
                    }
                });
            });
        </script>

        <!-- Sezione due 'NASCONDI IL SECONDO DIV E MOSTRA IL TERZO' -->
        <script>
            const avantiButton = document.getElementById('avantiButton');

            const secondaParte = document.getElementById('secondaParte');
            const terzaParte = document.getElementById('terzaParte');

            avantiButton.addEventListener('click', () => {
                secondaParte.classList.add('hidden');
                terzaParte.classList.remove('hidden');
                // Aspetta 4 secondi (4000 millisecondi) e ricarica la pagina
                setTimeout(() => {
                    location.reload();
                }, 4000);
            });

        </script>

        <script>
            const alerts = [
                `<div class="alert alert-success d-flex" role="alert"> 
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>Operazione completata</div>
                </div>`,
                `<div class="alert alert-primary d-flex" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div><b>Inventory</b> updated successfully!</div>
                </div>`,
                `<div class="alert alert-primary d-flex" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div><b>E-Commerce</b> updated successfully!</div>
                </div>`,
                `<div class="alert alert-primary d-flex" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div><b>Sales</b> updated successfully!</div>
                </div>`
            ];

            const container = document.getElementById('alerts-container');

            alerts.forEach((alert, index) => {
                setTimeout(() => {
                    const div = document.createElement('div');
                    div.innerHTML = alert;
                    div.classList.add('fade-in');
                    container.appendChild(div);
                }, Math.random() * 2000 + index * 1000); // Intervallo casuale
            });
        </script>
    <!-- FINE JAVASCRIP -->


</body>
</html>
