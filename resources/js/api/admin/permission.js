import Resource from '@/api/resource';

export default class RoleResource extends Resource {
  constructor() {
    super('/admin/permissions');
  }
}
