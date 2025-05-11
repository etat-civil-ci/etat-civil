<!DOCTYPE html>
<html>
<head>
    <title>Acte de Décès - {{ $acte->numero_acte }}</title>
    <style>
        body { 
            font-family: "Times New Roman", serif;
            line-height: 1.5;
        }
        .header { 
            text-align: center; 
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .content { 
            margin: 0 auto; 
            width: 80%;
        }
        .footer { 
            text-align: center; 
            margin-top: 40px; 
            font-size: 0.9em;
            border-top: 1px solid #000;
            padding-top: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0 25px 0;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #000;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            width: 35%;
            font-weight: normal;
        }
        h3 {
            font-size: 1.1em;
            margin: 25px 0 10px 0;
            text-decoration: underline;
        }
        .official-stamp {
            float: right;
            margin: 20px;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>RÉPUBLIQUE DU BÉNIN</h2>
        <h3>MINISTÈRE DE L'INTÉRIEUR ET DE LA SÉCURITÉ PUBLIQUE</h3>
        <h2>ACTE DE DÉCÈS N° {{ $acte->numero_acte }}</h2>
    </div>
    
    <div class="content">
        <h3>I. INFORMATIONS SUR LE DÉFUNT</h3>
        <table>
            <tr>
                <th>Nom et prénoms</th>
                <td><strong>{{ strtoupper($acte->nom_defunt) }} {{ ucwords($acte->prenom_defunt) }}</strong></td>
            </tr>
            <tr>
                <th>Date de décès</th>
                <td>{{ $acte->date_deces ? \Carbon\Carbon::parse($acte->date_deces)->locale('fr')->isoFormat('LL') : 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Lieu de décès</th>
                <td>{{ $acte->lieu_deces ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <th>Cause du décès</th>
                <td>{{ $acte->cause_deces ?? 'Non spécifiée' }}</td>
            </tr>
        </table>
        
        <h3>II. INFORMATIONS SUR LE DÉCLARANT</h3>
        <table>
            <tr>
                <th>Nom et prénoms</th>
                <td>{{ ucwords($acte->nom_declarant) }} {{ ucwords($acte->prenom_declarant) }}</td>
            </tr>
            <tr>
                <th>Lien avec le défunt</th>
                <td>{{ ucfirst($acte->filiation) }}</td>
            </tr>
            <tr>
                <th>Date de déclaration</th>
                <td>{{ $acte->date_acte ? \Carbon\Carbon::parse($acte->date_acte)->locale('fr')->isoFormat('LL') : '' }}</td>
            </tr>
        </table>
        
        <h3>III. INFORMATIONS SUR LES PARENTS</h3>
        <table>
            <tr>
                <th>Nom du père</th>
                <td>{{ $acte->nom_pere ? ucwords($acte->nom_pere) : 'Non renseigné' }}</td>
            </tr>
            <tr>
                <th>Nom de la mère</th>
                <td>{{ $acte->nom_mere ? ucwords($acte->nom_mere) : 'Non renseigné' }}</td>
            </tr>
        </table>
        
        <h3>IV. MENTIONS OFFICIELLES</h3>
        <table>
            <tr>
                <th>Date d'établissement</th>
                <td>{{ \Carbon\Carbon::parse($acte->created_at)->locale('fr')->isoFormat('LL') }}</td>
            </tr>
            <tr>
                <th>Lieu d'établissement</th>
                <td>{{ $acte->localite->nom ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <th>Officier d'état civil</th>
                <td>
                    <div class="official-stamp">
                        <p>Le Responsable de l'État Civil</p>
                        <p>Cachet et signature</p>
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer">
            <p>Document généré électroniquement le {{ now()->locale('fr')->isoFormat('LLLL') }}</p>
            <p>Copie certifiée conforme à l'original déposé au registre</p>
        </div>
    </div>
</body>
</html>