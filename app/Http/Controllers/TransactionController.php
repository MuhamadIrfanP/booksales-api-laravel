<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi (Admin)
    public function index()
    {
        $transactions = Transaction::with(['customer', 'book'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi berhasil diambil',
            'data' => $transactions
        ]);
    }

    // Membuat transaksi (Customer)
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $book = Book::findOrFail($request->book_id);

        $transaction = Transaction::create([
            'order_number' => 'TRX' . now()->format('YmdHis') . random_int(100, 999),
            'customer_id' => $request->user()->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'total_amount' => $book->price * $request->quantity,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaction->load(['customer', 'book'])
        ], 201);
    }

    // Melihat detail transaksi milik customer
    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'book'])
            ->where('customer_id', auth()->id())
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail transaksi berhasil diambil',
            'data' => $transaction
        ]);
    }

    // Mengubah transaksi milik customer
    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'book_id' => 'sometimes|required|exists:books,id',
            'quantity' => 'sometimes|required|integer|min:1'
        ]);

        $bookId = $request->input('book_id', $transaction->book_id);
        $quantity = $request->input('quantity', $transaction->quantity);

        $book = Book::findOrFail($bookId);

        $transaction->update([
            'book_id' => $book->id,
            'quantity' => $quantity,
            'total_amount' => $book->price * $quantity
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diperbarui',
            'data' => $transaction->load(['customer', 'book'])
        ]);
    }

    // Menghapus transaksi (Admin)
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }
}