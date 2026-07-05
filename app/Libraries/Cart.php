<?php

namespace App\Libraries;

class Cart
{
    protected string $sessionKey = 'freshwash_cart';

    public function insert(array $item): bool
    {
        if (empty($item['id']) || empty($item['nama']) || ! isset($item['harga'])) {
            return false;
        }

        $cart = $this->getContents();
        $id   = (int) $item['id'];

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += (int) ($item['qty'] ?? 1);
        } else {
            $cart[$id] = [
                'id'      => $id,
                'nama'    => $item['nama'],
                'harga'   => (float) $item['harga'],
                'satuan'  => $item['satuan'] ?? 'pcs',
                'qty'     => (int) ($item['qty'] ?? 1),
                'subtotal' => 0,
            ];
        }

        $cart[$id]['subtotal'] = $cart[$id]['harga'] * $cart[$id]['qty'];

        session()->set($this->sessionKey, $cart);
        return true;
    }

    public function update(int $id, int $qty): bool
    {
        $cart = $this->getContents();

        if (! isset($cart[$id])) {
            return false;
        }

        if ($qty <= 0) {
            return $this->remove($id);
        }

        $cart[$id]['qty']      = $qty;
        $cart[$id]['subtotal'] = $cart[$id]['harga'] * $qty;

        session()->set($this->sessionKey, $cart);
        return true;
    }

    public function remove(int $id): bool
    {
        $cart = $this->getContents();

        if (! isset($cart[$id])) {
            return false;
        }

        unset($cart[$id]);
        session()->set($this->sessionKey, $cart);
        return true;
    }

    public function total(): float
    {
        $cart = $this->getContents();

        if (empty($cart)) {
            return 0.0;
        }

        return (float) array_sum(array_column($cart, 'subtotal'));
    }

    public function destroy(): void
    {
        session()->remove($this->sessionKey);
    }

    public function getContents(): array
    {
        return session()->get($this->sessionKey) ?? [];
    }

    public function count(): int
    {
        return count($this->getContents());
    }

    public function totalQty(): int
    {
        $cart = $this->getContents();

        if (empty($cart)) {
            return 0;
        }

        return (int) array_sum(array_column($cart, 'qty'));
    }
}
