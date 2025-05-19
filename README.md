#  Architect Labs - Widget Basket

OOP Implementation of simple basket with delivery rules + discount rules.
---

## Features

- Modular basket implementation using strategy pattern
- PSR-4 autoloaded with Composer
- Delivery rules as injectable strategies
- Discount rules as pluggable interfaces
- Fully Dockerized setup

---

## Environment

- PHP 8.2 (CLI)
- Composer
- Docker + Docker Compose
- BC Math

---

## Product Catalogue

| Code | Name         | Price   |
|------|--------------|---------|
| R01  | Red Widget   | $32.95  |
| G01  | Green Widget | $24.95  |
| B01  | Blue Widget  | $7.95   |

---

## Delivery Rules

| Subtotal        | Fee   |
|-----------------|--------|
| < $50           | $4.95 |
| < $90 (≥ $50)   | $2.95 |
| ≥ $90           | Free  |

---

## Discount Rules

- Buy 1 Red Widget (`R01`), get the 2nd at half price

---

## Setup

### 1. Clone & Build

```bash
git clone https://github.com/yourusername/acme-basket.git
cd acme-basket
docker-compose up -d --build
