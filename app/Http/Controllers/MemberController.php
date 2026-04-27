<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'nullable|string|max:100',
            'role' => 'required|in:family,volunteer,health_pro,educator,partner,donor,other',
            'message' => 'nullable|string|max:1000',
        ]);

        Member::create($validated);

        return back()->with('success', 'Cadastro recebido! Entraremos em contato em breve.');
    }
}
