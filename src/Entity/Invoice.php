<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}},
 *     paginationEnabled=false
 * )
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class)
     * @Groups({"write"})
     * @MaxDepth(1)
     */
    private $items;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     */
    private $client;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read"})
     */
    private $timestamp;

    /**
     * @ORM\ManyToOne(targetEntity=InvoiceStatus::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "write"})
     */
    private $status;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */
    private $total_price;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */
    private $items_price;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */
    private $vat;

    /**
     * @ORM\OneToMany(targetEntity=PurchasedItem::class, mappedBy="invoice")
     * @Groups({"read"})
     */
    private $purchased_items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->purchased_items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        $this->items->removeElement($item);

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getStatus(): ?InvoiceStatus
    {
        return $this->status;
    }

    public function setStatus(?InvoiceStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(?float $total_price)
    {
        $this->total_price = $total_price;
    }

    public function setItemsPrice(?float $items_price)
    {
        $this->items_price = $items_price;
    }

    public function setVat(?float $vat)
    {
        $this->vat = $vat;
    }

    public function getItemsPrice(): ?float
    {
        return $this->items_price;
    }

    public function getVat(): ?float
    {
        return $this->vat;
    }

    /**
     * @return Collection|PurchasedItem[]
     */
    public function getPurchasedItems(): Collection
    {
        return $this->purchased_items;
    }

    public function addPurchasedItem(PurchasedItem $purchasedItem): self
    {
        if (!$this->purchased_items->contains($purchasedItem)) {
            $this->purchased_items[] = $purchasedItem;
            $purchasedItem->setInvoice($this);
        }

        return $this;
    }

    public function removePurchasedItem(PurchasedItem $purchasedItem): self
    {
        if ($this->purchased_items->removeElement($purchasedItem)) {
            // set the owning side to null (unless already changed)
            if ($purchasedItem->getInvoice() === $this) {
                $purchasedItem->setInvoice(null);
            }
        }

        return $this;
    }

}
