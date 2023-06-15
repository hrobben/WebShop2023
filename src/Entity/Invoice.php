<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $moment = null;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: InvoiceRow::class, orphanRemoval: true)]
    private Collection $invoiceRows;

    public function __construct()
    {
        $this->invoiceRows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMoment(): ?\DateTimeInterface
    {
        return $this->moment;
    }

    public function setMoment(\DateTimeInterface $moment): self
    {
        $this->moment = $moment;

        return $this;
    }

    /**
     * @return Collection<int, InvoiceRow>
     */
    public function getInvoiceRows(): Collection
    {
        return $this->invoiceRows;
    }

    public function addInvoiceRow(InvoiceRow $invoiceRow): self
    {
        if (!$this->invoiceRows->contains($invoiceRow)) {
            $this->invoiceRows->add($invoiceRow);
            $invoiceRow->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceRow(InvoiceRow $invoiceRow): self
    {
        if ($this->invoiceRows->removeElement($invoiceRow)) {
            // set the owning side to null (unless already changed)
            if ($invoiceRow->getInvoice() === $this) {
                $invoiceRow->setInvoice(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->getId();
    }
}
