<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
        }
        .order-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .order-info p {
            margin: 8px 0;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .products-table th,
        .products-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .products-table th {
            background: #667eea;
            color: white;
        }
        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
            margin-top: 20px;
        }
        .footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- HEADER -->
        <div class="header">
            <h1>✅ Commande Confirmée !</h1>
            <p>Merci pour votre commande, {{ $commande->user->name }}</p>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <p>Bonjour <strong>{{ $commande->user->name }}</strong>,</p>
            <p>Nous avons bien reçu votre commande et nous vous remercions pour votre confiance.</p>

            <!-- INFOS COMMANDE -->
            <div class="order-info">
                <p><strong>📦 N° de commande :</strong> #{{ $commande->id }}</p>
                <p><strong>📅 Date :</strong> {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                <p><strong>💳 Statut :</strong> En attente de validation</p>
                <p><strong>💰 Total :</strong> {{ number_format($commande->total, 0, ',', ' ') }} FCFA</p>
            </div>

            <!-- DÉTAILS COMMANDE -->
            <h3>📋 Détails de votre commande</h3>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->products as $produit)
                        <tr>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->pivot->quantite }}</td>
                            <td>{{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td>{{ number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                Total : {{ number_format($commande->total, 0, ',', ' ') }} FCFA
            </div>

            <!-- ADRESSE -->
            <h3>🚚 Adresse de livraison</h3>
            <div class="order-info">
                <p style="white-space: pre-line;">{{ $commande->adresse_livraison }}</p>
            </div>

            <!-- PROCHAINES ÉTAPES -->
            <h3>📌 Prochaines étapes</h3>
            <ol>
                <li>Nous allons vérifier votre commande</li>
                <li>Vous recevrez une confirmation de validation</li>
                <li>Votre commande sera préparée et expédiée</li>
                <li>Livraison sous 2-5 jours ouvrés</li>
            </ol>

            <center>
                <a href="{{ route('home') }}" class="btn">Retour à la boutique</a>
            </center>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>© 2026 Shop - Tous droits réservés</p>
            <p>Si vous avez des questions, contactez-nous à support@shop.com</p>
        </div>
    </div>
</body>
</html>
