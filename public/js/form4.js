


    function showContentBasedOnGender() {
        var gender = document.getElementById('genderSelect').value;

        // Cacher tous les contenus
        document.getElementById('content1').style.display = 'none';
        document.getElementById('content2').style.display = 'none';

        // Afficher le contenu en fonction du sexe choisi
        if (gender === 'homme') {
            document.getElementById('content1').style.display = 'block';
        } else if (gender === 'femme') {
            document.getElementById('content2').style.display = 'block';
        }
    }

    document.getElementById('myForm4').addEventListener('submit', function(event) {
        var gender = document.getElementById('genderSelect').value;
        var email = document.getElementById("email").value;
        var motpass = document.getElementById("motpass").value;
        var confirmmotpass = document.getElementById("confirmmotpass").value;
        var pseudo = document.getElementById("pseudo").value;
        var numtel = document.getElementById("numtel").value;
        var age = document.getElementById("age").value;
        var ville = document.getElementById("ville").value;
        var imgprofil = document.getElementById("file").value; // Correction : utiliser l'ID correct
        var agree = document.getElementById('agree');

        var errorMessage1 = document.getElementById('error-message1');
        var errorMessage3 = document.getElementById('error-message3');
        var errorMessage4 = document.getElementById('error-message4');
        var errorMessage5 = document.getElementById('error-message5');
        var errorMessage6 = document.getElementById('error-message6');
        var errorMessage7 = document.getElementById('error-message7');
        var errorMessage9 = document.getElementById('error-message9'); // Conditions

        var isValid = true;

        // Vérification des champs de base
        if (email === "") {
            errorMessage1.style.display = 'block';
            isValid = false;
        } else {
            errorMessage1.style.display = 'none';
        }

        if (pseudo === "") {
            errorMessage3.style.display = 'block';
            isValid = false;
        } else {
            errorMessage3.style.display = 'none';
        }

        if (motpass === "" || confirmmotpass === "") {
            errorMessage4.style.display = 'block';
            isValid = false;
        } else if (motpass !== confirmmotpass) {
            errorMessage4.innerText = 'Les mots de passe ne correspondent pas.';
            errorMessage4.style.display = 'block';
            isValid = false;
        } else {
            errorMessage4.style.display = 'none';
        }

        // Vérification pour les femmes
        if (gender === "femme") {
            if (numtel === "") {
                errorMessage5.style.display = 'block';
                isValid = false;
            } else {
                errorMessage5.style.display = 'none';
            }

            if (age === "") {
                errorMessage6.style.display = 'block';
                isValid = false;
            } else {
                errorMessage6.style.display = 'none';
            }

            if (ville === "") {
                errorMessage7.style.display = 'block';
                isValid = false;
            } else {
                errorMessage7.style.display = 'none';
            }

            if (imgprofil === "") {
                errorMessage7.style.display = 'block';
                isValid = false;
            } else {
                errorMessage7.style.display = 'none';
            }
        }

        // Vérification des conditions
        if (!agree.checked) {
            errorMessage9.style.display = 'block';
            isValid = false;
        } else {
            errorMessage9.style.display = 'none';
        }

        // Empêche la soumission si une erreur existe
        if (!isValid) {
            event.preventDefault();
        }
    });


        document.getElementById("submit-form").addEventListener("click", function(event) {
            event.preventDefault(); // Empêche l'envoi immédiat du formulaire

            // Récupérer la valeur de l'indicatif du pays
            var countryCode = document.getElementById("country-code").value;

            // Récupérer la valeur du numéro de téléphone
            var phoneNumber = document.getElementById("numtel").value;

            // Concaténer l'indicatif et le numéro de téléphone
            var fullPhoneNumber = countryCode + phoneNumber;

            // Ajouter le numéro de téléphone complet au formulaire (si vous soumettez via JavaScript)
            var phoneField = document.createElement("input");
            phoneField.type = "hidden"; // Cacher ce champ dans le formulaire
            phoneField.name = "tel"; // Le même nom que dans le formulaire
            phoneField.value = fullPhoneNumber;

            // Ajoutez ce champ caché au formulaire avant de soumettre
            document.forms[0].appendChild(phoneField);

            // Soumettre le formulaire
            document.forms[0].submit();
        });


                function updatePrefix() {
            const select = document.getElementById('country-code');
            const selectedOption = select.options[select.selectedIndex];
            const prefix = selectedOption.value;

            // Inject the prefix directly into the input as a placeholder
            const input = document.getElementById('numtel');
            input.placeholder = `Numéro de téléphone (${prefix})`;
        }

        function showFileName() {
        var input = document.getElementById('file');
        var fileNameDisplay = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDisplay.textContent = input.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Aucun fichier choisi';
        }
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const password = document.getElementById('motpass').value;
        const confirmPassword = document.getElementById('confirmmotpass').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Empêche la soumission du formulaire
            document.getElementById('passwordError').style.display = 'block';
        } else {
            document.getElementById('passwordError').style.display = 'none';
        }
    });


