<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function index(): View
    {
        if (Auth::user()->role == 'admin') {
            $borrowings = Borrowing::with(['user','book'])->latest()->get();
            return view('borrowing.admin.index', compact('borrowings'));
        }

        $borrowings = Borrowing::with(['book'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('borrowing.user.index', compact('borrowings'));
    }

    public function create(): View
    {
        if (Auth::user()->role === 'admin') {
            abort(403);
        }

        $books = Book::where('stock', '>', 0)->get();
        return view('borrowing.create', compact('books'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->role === 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrowed_at'
        ]);

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'borrowed_at' => $validated['borrowed_at'],
            'return_date' => $validated['return_date'],
            'status' => 'pending'
        ]);

        return redirect()->route('borrowings.index')
            ->with('success', 'Menunggu approval admin');
    }

    // ✅ APPROVE PINJAM (ADMIN)
    public function approve(Borrowing $borrowing): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($borrowing->status !== 'pending') {
            return back()->withErrors('Sudah diproses');
        }

        if ($borrowing->book->stock <= 0) {
            return back()->withErrors('Stock habis');
        }

        $borrowing->update([
            'status' => 'dipinjam'
        ]);

        $borrowing->book->decrement('stock');

        return back()->with('success', 'Peminjaman disetujui');
    }

    // ✅ USER AJUKAN PENGEMBALIAN
    public function requestReturn(Borrowing $borrowing): RedirectResponse
    {
        if (Auth::user()->role === 'admin') {
            abort(403);
        }

        if ($borrowing->user_id !== Auth::id()) {
            abort(403);
        }

        if ($borrowing->status !== 'dipinjam') {
            return back()->withErrors('Tidak bisa request');
        }

        $borrowing->update([
            'status' => 'kembali_req'
        ]);

        return back()->with('success', 'Menunggu approval pengembalian');
    }

    // ✅ ADMIN APPROVE PENGEMBALIAN
    public function approveReturn(Borrowing $borrowing): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($borrowing->status !== 'kembali_req') {
            return back()->withErrors('Belum diajukan');
        }

        $borrowing->update([
            'status' => 'dikembalikan',
            'returned_at' => now()
        ]);

        $borrowing->book->increment('stock');

        return back()->with('success', 'Pengembalian disetujui');
    }

    // ✅ DELETE (AMAN)
    public function destroy(Borrowing $borrowing): RedirectResponse
    {
        $user = Auth::user();

        // admin bebas
        if ($user->role !== 'admin') {
            // user hanya boleh hapus miliknya
            if ($borrowing->user_id !== $user->id) {
                abort(403);
            }

            // hanya boleh hapus kalau pending
            if ($borrowing->status !== 'pending') {
                return back()->withErrors('Tidak bisa hapus transaksi ini');
            }
        }

        // balikin stok kalau sudah dipinjam
        if ($borrowing->status === 'dipinjam') {
            $borrowing->book->increment('stock');
        }

        $borrowing->delete();

        return back()->with('success', 'Data dihapus');
    }
}