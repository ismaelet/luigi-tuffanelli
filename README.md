# Luigi Tuffanelli

A custom PHP website developed to present information, content, and professional material related to Luigi Tuffanelli.

The project was built using traditional web technologies, with an emphasis on creating a dedicated website without relying on a full-stack application framework.

## About the Project

This repository contains the source code for a website dedicated to Luigi Tuffanelli.

The application was developed using a custom PHP architecture to handle server-side functionality and page rendering, alongside HTML, CSS, and JavaScript for the frontend.

The project is preserved as part of my web development portfolio, documenting my experience building websites using native technologies and custom application structures.

## Technologies

The website uses:

- **PHP** — Server-side logic and dynamic page rendering
- **HTML5** — Page structure and content
- **CSS3** — Styling and layout
- **JavaScript** — Client-side interactions
- **Composer** — Dependency management and environment configuration

The project uses a custom PHP structure rather than a full-stack application framework.

## Project Structure

The main directories include:

| Directory | Description |
|---|---|
| `app/` | Application configuration and supporting logic |
| `pages/` | Website pages, content, and associated resources |
| `system/` | Core application functionality |
| `uploads/` | Directory reserved for uploaded content |

## Technical Approach

### Custom PHP Architecture

The project uses a traditional server-rendered approach, where PHP manages application logic and generates dynamic web content.

Working without a full-stack framework provided experience with application structure, reusable PHP components, request handling, and configuration management.

### Frontend Development

The interface uses HTML, CSS, and JavaScript to present content and support user interactions.

### Environment Configuration

Application configuration is separated from environment-specific credentials.

Sensitive settings are loaded through environment variables rather than being stored directly in source code.

A `.env.example` file provides a template for configuring the application without exposing private information.

## Development Context

The project reflects an earlier stage of my experience as a web developer and demonstrates my work with traditional PHP applications.

It is retained as a portfolio project and as a reference for the evolution of my development practices.

## Project Status

**Legacy project**

The repository contains the original application architecture, with security-related repository maintenance performed to remove historical credentials and improve configuration management.

The application has not been verified as production-ready in its current state.

## Security

Sensitive credentials are excluded from version control.

The repository has undergone a Git history cleanup to remove previously committed database credentials. Environment-specific configuration is managed through local `.env` files.

Before any production deployment, the application should undergo additional functional and security testing.

## License

No open-source license is currently specified. All rights are reserved unless otherwise stated.

Third-party assets and dependencies remain subject to their respective licenses.