<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy(User $user)
    {
        // Empêche la suppression de l'utilisateur actuellement connecté
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user->delete();
        
        return redirect()->route('account')
            ->with('success', 'Utilisateur supprimé avec succès');
    }
}