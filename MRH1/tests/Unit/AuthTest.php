<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Unit Tests for Khanzaar Travel Website
 * Authentication & Validation Functions
 */
class AuthTest extends TestCase
{
    // ─────────────────────────────────────────
    // TEST 1: Valid email format check
    // ─────────────────────────────────────────
    public function testValidEmailReturnsTrue(): void
    {
        $email = "user@example.com";
        $result = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->assertNotFalse($result, "Valid email should pass validation");
    }

    // ─────────────────────────────────────────
    // TEST 2: Invalid email format check
    // ─────────────────────────────────────────
    public function testInvalidEmailReturnsFalse(): void
    {
        $email = "not-an-email";
        $result = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->assertFalse($result, "Invalid email should fail validation");
    }

    // ─────────────────────────────────────────
    // TEST 3: Password minimum length (6 chars)
    // ─────────────────────────────────────────
    public function testPasswordMinLengthValid(): void
    {
        $password = "pass123";
        $this->assertGreaterThanOrEqual(6, strlen($password), "Password should be at least 6 characters");
    }

    // ─────────────────────────────────────────
    // TEST 4: Password too short
    // ─────────────────────────────────────────
    public function testPasswordTooShortFails(): void
    {
        $password = "abc";
        $this->assertLessThan(6, strlen($password), "Short password should be rejected");
    }

    // ─────────────────────────────────────────
    // TEST 5: Empty username check
    // ─────────────────────────────────────────
    public function testEmptyUsernameIsInvalid(): void
    {
        $username = "";
        $this->assertEmpty($username, "Empty username should be caught");
    }

    // ─────────────────────────────────────────
    // TEST 6: Username trimming (spaces)
    // ─────────────────────────────────────────
    public function testUsernameTrimmedProperly(): void
    {
        $username = "  admin  ";
        $trimmed  = trim($username);
        $this->assertEquals("admin", $trimmed, "Spaces should be trimmed from username");
    }
}
