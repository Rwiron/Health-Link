# Health Link Management System

## Functional Requirements

### 1. Multi-Tenant User Management
- The system should allow hospitals to register and create their accounts to use the platform.
- Each hospital (tenant) can manage its own users with specific roles:
  - **Patient**: Access patient-related features such as viewing doctors and scheduling appointments within their registered hospital.
  - **Doctor**: Access doctor-related features such as managing schedules and patient data within their hospital.
  - **Admin**: Access administrative features like generating reports and managing hospital-specific data.
- Super Admin (platform owner) can oversee all tenant accounts.
- Role-based access control to ensure users only access features appropriate to their role and hospital.

### 2. Hospital Registration
- Hospitals can register on the platform.

### 3. Appointment Scheduling
- Patients should be able to:
  - View available doctors within their registered hospital.
  - Schedule appointments directly through the system.
- Real-time updates on doctor availability.

### 4. Real-Time Updates
- Provide real-time updates on:
  - Doctor availability.
  - Medical services.
  - Resources.
  - Facility hours.
  - Appointment changes.

### 5. Reporting
- Healthcare administrators should have the ability to:
  - Generate weekly and monthly reports.
  - Include metrics such as hospital performance, patient data, and medical supply usage.
- Super Admin should access aggregated reports for all registered hospitals.

### 6. Insurance Provider Information
- Patients should be able to:
  - View accepted insurance providers.
  - View coverage details.
- Hospitals can manage their accepted insurance providers list.

### 7. Location-Based Facility Finder
- The system should allow patients to:
  - Input their location manually.
  - Use GPS to automatically determine their location.
  - Find the nearest healthcare facilities based on their service needs.
- Ensure patients only see facilities registered within the system.

### 8. Rural Patient Support
- Real-time updates to help patients in rural areas:
  - Avoid unnecessary trips.
  - Plan visits according to updated facility hours and doctor availability.
- Offline access to basic healthcare data and appointment schedules if internet connectivity is unavailable.

---

## Technology Stack

- **Frontend**:
  - React.js
  - Redux
  - Tailwind CSS
  - HTML5
  - CSS3
  - JavaScript (ES6+)

- **Backend**:
  - Laravel
  - Node.js
  - Express.js

- **Database**:
  - MySQL
  - MongoDB
  - Mongoose

- **Authentication**:
  - JWT (JSON Web Tokens)
  - OAuth 2.0

- **Real-Time Updates**:
  - Socket.io

- **DevOps**:
  - Docker
  - Kubernetes
  - Jenkins

- **Cloud Services**:
  - AWS (Amazon Web Services)
  - Azure

- **Hosting**:
  - Hostinger

- **Other Tools**:
  - Git
  - Postman
  - Swagger (API Documentation)

---

## Flow Journey Examples

### Patient Journey
1. **Registration/Login**:
   - A patient registers on the platform through their hospital's portal or logs in using their credentials.
2. **View Doctors**:
   - The patient searches for doctors by specialization or availability within their hospital.
3. **Appointment Booking**:
   - The patient selects an available doctor and schedules an appointment.
4. **Receive Updates**:
   - The system sends notifications about the appointment confirmation or any changes to availability.
5. **Location Search**:
   - The patient uses the facility finder to locate the nearest healthcare facility for their appointment.

### Doctor Journey
1. **Login**:
   - The doctor logs into the system to access their dashboard.
2. **View Appointments**:
   - They review their scheduled appointments for the day.
3. **Update Availability**:
   - If required, they adjust their availability to reflect emergencies or schedule changes.
4. **Patient Interaction**:
   - The doctor manages patient data, including notes and medical histories during consultations.

### Admin Journey
1. **Login**:
   - The admin logs in to their hospital's dashboard.
2. **Manage Users**:
   - They create, update, or remove accounts for patients and doctors within their hospital.
3. **Generate Reports**:
   - The admin generates reports on hospital performance, patient metrics, and resource usage.
4. **Update Insurance Providers**:
   - The admin ensures the list of accepted insurance providers is up to date for patient reference.

### Super Admin Journey
1. **Login**:
   - The Super Admin logs into the platform dashboard.
2. **Monitor Hospitals**:
   - They view the status of all registered hospitals, including performance metrics and user activity.
3. **Support Hospitals**:
   - They provide support or address any issues reported by hospital admins.
4. **Oversee Reports**:
   - The Super Admin reviews aggregated reports to identify trends and opportunities for system improvement.

---
