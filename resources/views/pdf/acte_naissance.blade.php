<!DOCTYPE html>
<html>
<head>
    <title>Acte de Naissance - {{ $acte->numero_acte }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 0 auto; width: 90%; }
        .footer { text-align: center; margin-top: 50px; font-size: 0.8em; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h2>ACTE DE NAISSANCE</h2>
        <p>République du Bénin</p>
    </div>
    
    <div class="content">
        <h3>Informations de l'enfant</h3>
        <table>
            <tr><td>Nom complet</td><td>{{ $acte->nom_enfant }} {{ $acte->prenom_enfant }}</td></tr>
            <tr><td>Date de naissance</td><td>{{ $acte->date_naissance->format('d/m/Y') }}</td></tr>
           
        </table>
        
        <h3>Informations des parents</h3>
        
        <div class="footer">
            <p>Document généré le {{ now()->format('d/m/Y H:i') }}</p>
            <p>Copie certifiée conforme</p>
        </div>
    </div>
</body>
</html>