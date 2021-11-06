<?php

namespace App\Entity;

use App\Repository\PurchasedItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PurchasedItemRepository::class)
 */
class PurchasedItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"})
     */
    private $store_item;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */
    private $purchase_price;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="purchased_items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $invoice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStoreItem(): ?Item
    {
        return $this->store_item;
    }

    public function setStoreItem(?Item $store_item): self
    {
        $this->store_item = $store_item;

        return $this;
    }

    public function getPurchasePrice(): ?float
    {
        return $this->purchase_price;
    }

    public function setPurchasePrice(float $purchase_price): self
    {
        $this->purchase_price = $purchase_price;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }
}
