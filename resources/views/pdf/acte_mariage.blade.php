<!DOCTYPE html>
<html>
<head>
    <title>Acte de Mariage - {{ $acte->numero_acte }}</title>
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
        <h2>ACTE DE MARIAGE N° {{ $acte->numero_acte }}</h2>
    </div>
    
    <div class="content">
        <h3>I. INFORMATIONS SUR LES ÉPOUX</h3>
        <table>
            <tr>
                <th>Nom et prénoms de l'époux</th>
                <td><strong>{{ strtoupper($acte->nom_epoux) }} {{ ucwords($acte->prenom_epoux) }}</strong></td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ $acte->date_naissance_epoux ? \Carbon\Carbon::parse($acte->date_naissance_epoux)->locale('fr')->isoFormat('LL') : 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Lieu de naissance</th>
                <td>{{ $acte->lieu_naissance_epoux ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <th>Profession</th>
                <td>{{ $acte->profession_epoux ?? 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Domicile</th>
                <td>{{ $acte->domicile_epoux ?? 'Non spécifié' }}</td>
            </tr>
        </table>
        
        <table>
            <tr>
                <th>Nom et prénoms de l'épouse</th>
                <td><strong>{{ strtoupper($acte->nom_epouse) }} {{ ucwords($acte->prenom_epouse) }}</strong></td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ $acte->date_naissance_epouse ? \Carbon\Carbon::parse($acte->date_naissance_epouse)->locale('fr')->isoFormat('LL') : 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Lieu de naissance</th>
                <td>{{ $acte->lieu_naissance_epouse ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <th>Profession</th>
                <td>{{ $acte->profession_epouse ?? 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Domicile</th>
                <td>{{ $acte->domicile_epouse ?? 'Non spécifié' }}</td>
            </tr>
        </table>
        
        <h3>II. INFORMATIONS SUR LE MARIAGE</h3>
        <table>
            <tr>
                <th>Date du mariage</th>
                <td>{{ $acte->date_mariage ? \Carbon\Carbon::parse($acte->date_mariage)->locale('fr')->isoFormat('LL') : 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Lieu du mariage</th>
                <td>{{ $acte->lieu_mariage ?? 'Non spécifié' }}</td>
            </tr>
            <tr>
                <th>Date d'enregistrement</th>
                <td>{{ $acte->date_acte ? \Carbon\Carbon::parse($acte->date_acte)->locale('fr')->isoFormat('LL') : 'Non spécifiée' }}</td>
            </tr>
            <tr>
                <th>Localité d'enregistrement</th>
                <td>{{ $acte->localite->nom ?? 'Non spécifié' }}</td>
            </tr>
        </table>
        
        <h3>III. INFORMATIONS SUR LES TÉMOINS</h3>
        <table>
            <tr>
                <th>Témoin 1</th>
                <td>
                    {{ ucwords($acte->nom_temoin1) }} {{ ucwords($acte->prenom_temoin1) }}<br>
                    CNI: {{ $acte->numero_cni_temoin1 ?? 'Non spécifié' }}
                </td>
            </tr>
            <tr>
                <th>Témoin 2</th>
                <td>
                    {{ ucwords($acte->nom_temoin2) }} {{ ucwords($acte->prenom_temoin2) }}<br>
                    CNI: {{ $acte->numero_cni_temoin2 ?? 'Non spécifié' }}
                </td>
            </tr>
        </table>
        
        <h3>IV. MENTIONS OFFICIELLES</h3>
        <table>
            <tr>
                <th>Date d'établissement</th>
                <td>{{ \Carbon\Carbon::parse($acte->created_at)->locale('fr')->isoFormat('LL') }}</td>
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