@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- SweetAlert Messages -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'swal2-confirm'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'swal2-confirm'
                }
            });
        </script>
    @endif

    <!-- Page Header -->
    <div class="titrepage">
        <h4>RECHARGEMENT</h4>
        <h5>Mes packs</h5>
    </div>

    <!-- Recharge Form -->
    <form id="rechargementForm">
        @csrf
        <div class="mespacks">
            @foreach ($packs as $pack)
                <div class="button-like intpack1" data-price="{{ $pack->price }}" style="cursor: pointer;">
                    <h5>{{ $pack->number }}</h5>
                    <h5>Pièce</h5>
                    <h5 class="prixpack1">{{ $pack->price }} F</h5>
                </div>
            @endforeach
        </div>

        <!-- Payment Details -->
        <select class="inputtext" name="reseau" id="reseau" style="width: 250px; text-align: center; margin: 10px auto;">
            <option value="Mtn Benin">MTN Money</option>
            <option value="Flooz">Moov Money</option>
        </select>

        <div id="render" class="btncontactez">
            <div class="form-group">
                <label class="labelcache" for="numeroclient">Numéro de téléphone</label>
                <input class="inputtextpaie" type="text" id="numeroclient" name="numeroclient" placeholder="Numéro de téléphone" style="text-align: center;">
                <h5 class="prixpack2" id="selectedValueDisplay">0 F CFA</h5>
            </div>
            <button id='pay-btn' class="btninscription" type="button" onclick="initiateFedaPayPayment()">Payer</button>
        </div>
    </form>

    <!-- FedaPay Script -->
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    <script type="text/javascript">
        let selectedPackPrice = 0;

        // Sélection du pack
        document.querySelectorAll(".button-like").forEach(element => {
            element.addEventListener("click", function(event) {
                event.preventDefault();
                const price = element.getAttribute("data-price");
                selectedPackPrice = parseInt(price, 10);

                if (!isNaN(selectedPackPrice)) {
                    document.getElementById('selectedValueDisplay').innerHTML = selectedPackPrice + " F CFA";
                } else {
                    console.error("Erreur : le prix sélectionné est invalide.");
                }
            });
        });

        FedaPay.init('#pay-btn', {
        public_key: 'VOTRE_CLE_API_PUBLIQUE',
        transaction: {
          amount: 1000,
          description: 'Acheter mon produit'
        },
        customer: {
          email: 'johndoe@gmail.com',
          lastname: 'Doe',
          firstname: 'John',
        }
      });

        // Initiation du paiement avec FedaPay
           </script>
</div>
@endsection
