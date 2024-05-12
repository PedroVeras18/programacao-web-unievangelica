import { Car, Prisma } from '@prisma/client'

export interface CarsRepository {
  getAll(page: number): Promise<Car[]>
  findById(id: string): Promise<Car | null>
  create(data: Prisma.CarUncheckedCreateInput): Promise<Car>
  save(car: Car): Promise<Car>
  delete(anId: string): Promise<void>
}
