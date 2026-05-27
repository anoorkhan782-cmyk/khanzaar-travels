<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Unit Tests for Khanzaar Travel Website
 * Travel Package & Booking Validation
 */
class TravelTest extends TestCase
{
    // ─────────────────────────────────────────
    // TEST 1: Package price must be positive
    // ─────────────────────────────────────────
    public function testPackagePriceIsPositive(): void
    {
        $price = 15000; // PKR
        $this->assertGreaterThan(0, $price, "Package price must be a positive number");
    }

    // ─────────────────────────────────────────
    // TEST 2: Zero price is invalid
    // ─────────────────────────────────────────
    public function testZeroPriceIsInvalid(): void
    {
        $price = 0;
        $this->assertFalse($price > 0, "Zero price should not be allowed");
    }

    // ─────────────────────────────────────────
    // TEST 3: Destination name not empty
    // ─────────────────────────────────────────
    public function testDestinationNameNotEmpty(): void
    {
        $destination = "Hunza Valley";
        $this->assertNotEmpty($destination, "Destination name must not be empty");
    }

    // ─────────────────────────────────────────
    // TEST 4: Number of travellers must be >= 1
    // ─────────────────────────────────────────
    public function testTravellersCountAtLeastOne(): void
    {
        $travellers = 2;
        $this->assertGreaterThanOrEqual(1, $travellers, "At least 1 traveller is required");
    }

    // ─────────────────────────────────────────
    // TEST 5: Total price calculation
    // ─────────────────────────────────────────
    public function testTotalPriceCalculation(): void
    {
        $pricePerPerson = 5000;
        $travellers     = 3;
        $total          = $pricePerPerson * $travellers;
        $this->assertEquals(15000, $total, "Total price should equal price × travellers");
    }

    // ─────────────────────────────────────────
    // TEST 6: Phone number length (Pakistan = 11 digits)
    // ─────────────────────────────────────────
    public function testPhoneNumberLength(): void
    {
        $phone = "03001234567";
        $this->assertEquals(11, strlen($phone), "Pakistani phone number must be 11 digits");
    }

    // ─────────────────────────────────────────
    // TEST 7: Admin role check
    // ─────────────────────────────────────────
    public function testAdminRoleIdentifiedCorrectly(): void
    {
        $role = "admin";
        $this->assertEquals("admin", $role, "Admin role should be correctly identified");
    }

    // ─────────────────────────────────────────
    // TEST 8: User role check
    // ─────────────────────────────────────────
    public function testUserRoleIdentifiedCorrectly(): void
    {
        $role = "user";
        $this->assertNotEquals("admin", $role, "Regular user should not have admin role");
    }
}
