# 🚀 PayPal Integration Guide for SkillSwap

## 📋 Table of Contents
1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Database Structure](#database-structure)
4. [Payment Flow](#payment-flow)
5. [Code Explanation](#code-explanation)
6. [Setup Instructions](#setup-instructions)
7. [Testing](#testing)
8. [Troubleshooting](#troubleshooting)

---

## 🎯 Overview

This document explains the PayPal subscription integration in SkillSwap. The system handles:
- **Recurring payments** (monthly/yearly subscriptions)
- **Automatic billing** (no manual intervention needed)
- **Webhook processing** for real-time updates
- **Database synchronization** between PayPal and your app

---

## 🏗️ Architecture

### **Components:**
1. **PaymentController** - Handles payment flow and webhooks
2. **PayPalService** - Manages PayPal API interactions
3. **Database Models** - Store transaction and subscription data
4. **Webhooks** - Receive real-time updates from PayPal

### **Flow Diagram:**
```
User → Select Plan → PaymentController → PayPalService → PayPal API
                                                    ↓
PayPal Webhook → PaymentController → Update Database → User Status Updated
```

---

## 🗄️ Database Structure

### **New Tables Created:**

#### **1. `transactions` Table**
```sql
- id (Primary Key)
- user_id (Foreign Key to users)
- plan_id (Foreign Key to plans)
- paypal_order_id (PayPal's order ID)
- paypal_payment_id (PayPal's payment ID)
- paypal_subscription_id (PayPal's subscription ID)
- amount (Payment amount)
- currency (Payment currency)
- status (Payment status)
- payment_type (one_time/recurring)
- billing_period (monthly/yearly)
- paid_at (Payment timestamp)
- paypal_response (JSON response from PayPal)
```

#### **2. `plans` Table Updates**
```sql
- paypal_product_id (PayPal product ID)
- paypal_plan_id (PayPal billing plan ID)
- billing_period (monthly/yearly)
```

#### **3. `users` Table Updates**
```sql
- is_pro (Boolean: is user premium?)
- plan (String: plan name)
- paypal_subscription_id (PayPal subscription ID)
- subscription_status (active/cancelled/expired)
- subscribed_at (Subscription start date)
- current_period_end (Next billing date)
```

---

## 💳 Payment Flow

### **Step-by-Step Process:**

#### **1. User Selects Plan**
- User visits `/price` page
- Sees monthly/yearly plans
- Clicks "Subscribe Now" button

#### **2. Payment Initiation**
- `PaymentController@initiatePayment` is called
- Creates/retrieves PayPal product and plan IDs
- Creates transaction record in database
- Redirects user to PayPal approval page

#### **3. PayPal Payment**
- User completes payment on PayPal
- PayPal creates subscription
- User is redirected back to success/cancel URL

#### **4. Success/Cancel Handling**
- `PaymentController@success` or `@cancel` processes return
- Updates transaction status
- Updates user subscription details

#### **5. Webhook Processing**
- PayPal sends webhook events
- `PaymentController@webhook` processes events
- Updates user status based on subscription lifecycle

---

## 🔧 Code Explanation

### **PaymentController Methods:**

#### **1. `initiatePayment()`**
```php
public function initiatePayment(Request $request)
```
**What it does:**
- Validates plan selection
- Creates PayPal product if doesn't exist
- Creates PayPal billing plan if doesn't exist
- Creates transaction record
- Redirects to PayPal approval URL

**Key Steps:**
1. **Plan Validation**: Ensures plan exists and is valid
2. **PayPal Product Creation**: Creates product in PayPal (if needed)
3. **PayPal Plan Creation**: Creates billing plan in PayPal (if needed)
4. **Transaction Record**: Saves payment attempt to database
5. **PayPal Redirect**: Sends user to PayPal for payment

#### **2. `success()`**
```php
public function success(Request $request, $transactionId)
```
**What it does:**
- Handles user return from PayPal after successful payment
- Fetches subscription details from PayPal
- Updates transaction status to 'completed'
- Updates user subscription details

**Key Steps:**
1. **Transaction Lookup**: Finds transaction by ID
2. **PayPal Verification**: Gets subscription details from PayPal
3. **Status Update**: Marks transaction as completed
4. **User Update**: Sets user as premium with plan details

#### **3. `cancel()`**
```php
public function cancel(Request $request, $transactionId)
```
**What it does:**
- Handles user cancellation on PayPal
- Updates transaction status to 'cancelled'

#### **4. `webhook()`**
```php
public function webhook(Request $request)
```
**What it does:**
- Receives webhook events from PayPal
- Verifies webhook signature
- Routes events to appropriate handlers

**Webhook Events Handled:**
- `BILLING.SUBSCRIPTION.CREATED` → Subscription created
- `BILLING.SUBSCRIPTION.ACTIVATED` → Subscription activated
- `BILLING.SUBSCRIPTION.CANCELLED` → Subscription cancelled
- `BILLING.SUBSCRIPTION.EXPIRED` → Subscription expired
- `PAYMENT.SALE.COMPLETED` → Payment completed

#### **5. Webhook Handler Methods:**
- `handleSubscriptionCreated()` - New subscription
- `handleSubscriptionActivated()` - Subscription activated
- `handleSubscriptionCancelled()` - Subscription cancelled
- `handleSubscriptionExpired()` - Subscription expired
- `handlePaymentCompleted()` - Payment completed

### **PayPalService Methods:**

#### **1. `getAccessToken()`**
```php
public function getAccessToken()
```
**What it does:**
- Gets OAuth access token from PayPal
- Caches token for reuse
- Required for all PayPal API calls

#### **2. `createProduct()`**
```php
public function createProduct($name, $description)
```
**What it does:**
- Creates a product in PayPal
- Returns PayPal product ID
- Required before creating billing plans

#### **3. `createPlan()`**
```php
public function createPlan($name, $price, $billingPeriod)
```
**What it does:**
- Creates a billing plan in PayPal
- Sets up recurring billing parameters
- Links to PayPal product

#### **4. `createSubscription()`**
```php
public function createSubscription($planId, $returnUrl, $cancelUrl)
```
**What it does:**
- Creates subscription in PayPal
- Returns approval URL for user
- Sets up return/cancel URLs

#### **5. `getSubscription()`**
```php
public function getSubscription($subscriptionId)
```
**What it does:**
- Fetches subscription details from PayPal
- Used to verify payment status

#### **6. `cancelSubscription()`**
```php
public function cancelSubscription($subscriptionId)
```
**What it does:**
- Cancels active subscription
- Stops recurring billing

---

## ⚙️ Setup Instructions

### **1. PayPal Developer Account Setup**
1. Go to [PayPal Developer Dashboard](https://developer.paypal.com/)
2. Create a new app
3. Get **Client ID** and **Secret**
4. Set to **Sandbox** mode for testing

### **2. Environment Variables**
Add to your `.env` file:
```env
PAYPAL_CLIENT_ID=your_client_id_here
PAYPAL_SECRET=your_secret_here
PAYPAL_MODE=sandbox
PAYPAL_WEBHOOK_ID=your_webhook_id_here
PAYPAL_CURRENCY=USD
```

### **3. Webhook Setup**
1. In PayPal Dashboard, go to **Webhooks**
2. Create new webhook with URL: `https://yourdomain.com/payment/webhook`
3. Select these events:
   - `BILLING.SUBSCRIPTION.CREATED`
   - `BILLING.SUBSCRIPTION.ACTIVATED`
   - `BILLING.SUBSCRIPTION.CANCELLED`
   - `BILLING.SUBSCRIPTION.EXPIRED`
   - `PAYMENT.SALE.COMPLETED`

### **4. Database Migration**
Run these migrations:
```bash
php artisan migrate
```

---

## 🧪 Testing

### **1. Test Payment Flow**
1. Go to `/price` page
2. Select a plan
3. Click "Subscribe Now"
4. Complete payment on PayPal Sandbox
5. Check database for updates

### **2. Test Webhooks**
1. Use PayPal's webhook simulator
2. Send test events
3. Check logs for processing

### **3. Sandbox Accounts**
- Use PayPal Sandbox buyer account
- Test with different scenarios (success, cancel, failure)

---

## 🔍 Troubleshooting

### **Common Issues:**

#### **1. "PayPal product not found"**
- Check if `createProduct()` is working
- Verify PayPal API credentials

#### **2. "Webhook signature verification failed"**
- Check webhook URL in PayPal Dashboard
- Verify webhook is active

#### **3. "User not updated after payment"**
- Check webhook events are being received
- Verify webhook handlers are working
- Check user model `$fillable` array

#### **4. "Transaction not created"**
- Check database migrations ran successfully
- Verify transaction model exists

### **Debug Steps:**
1. Check Laravel logs (`storage/logs/laravel.log`)
2. Verify PayPal webhook events
3. Test individual methods with `php artisan tinker`
4. Check database state after operations

---

## 📚 Key Concepts

### **Why PayPal Products/Plans Are Needed:**
- **Required by PayPal API**: Cannot create subscriptions without them
- **Billing Management**: Handles recurring payments automatically
- **Webhook Integration**: Links events to your application
- **Professional Setup**: Follows PayPal best practices

### **Recurring vs One-Time Payments:**
- **Recurring (Current)**: Automatic monthly/yearly billing
- **One-Time**: Single payment, no automatic renewal
- **Current Setup**: Recurring payments with automatic billing

### **Webhook Importance:**
- **Real-time Updates**: Immediate notification of events
- **Reliable**: Handles network issues gracefully
- **Comprehensive**: Covers all subscription lifecycle events

---

## 🎉 Summary

This PayPal integration provides:
- ✅ **Fully automated** recurring billing
- ✅ **Real-time updates** via webhooks
- ✅ **Professional payment flow**
- ✅ **Database synchronization**
- ✅ **Error handling and recovery**

The system handles the complete subscription lifecycle automatically, requiring no manual intervention for recurring payments.
